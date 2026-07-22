<?php
declare(strict_types=1);
namespace App\Models;

use App\Helpers\Database;

abstract class BaseModel
{
    protected static string $table = '';
    protected array $fillable = [];
    protected array $guarded = ['id'];
    protected bool $timestamps = true;
    protected bool $softDeletes = false;
    protected array $with = [];
    protected array $eagerLoads = [];
    protected array $scopes = [];

    public static function getTable(): string
    {
        if (static::$table !== '') {
            return static::$table;
        }
        $class = (new \ReflectionClass(static::class))->getShortName();
        $table = preg_replace('/([a-z])([A-Z])/', '$1_$2', $class);
        return mb_strtolower($table) . 's';
    }

    public function getFillable(): array
    {
        return $this->fillable;
    }

    public function getGuarded(): array
    {
        return $this->guarded;
    }

    public static function find(int $id): ?static
    {
        $table = static::getTable();
        $instance = new static();
        $sql = "SELECT * FROM {$table} WHERE id = ?";
        if ($instance->softDeletes) {
            $sql .= " AND deleted_at IS NULL";
        }
        $data = Database::fetch($sql, [$id]);
        if (!$data) {
            return null;
        }
        return $instance->hydrate($data);
    }

    public static function findAll(string $orderBy = 'id ASC', ?int $limit = null, ?int $offset = null): array
    {
        $table = static::getTable();
        $instance = new static();
        $sql = "SELECT * FROM {$table}";
        if ($instance->softDeletes) {
            $sql .= " WHERE deleted_at IS NULL";
        }
        $sql .= " ORDER BY {$orderBy}";
        if ($limit !== null) {
            $sql .= " LIMIT {$limit}";
        }
        if ($offset !== null) {
            $sql .= " OFFSET {$offset}";
        }
        $results = Database::fetchAll($sql);
        return array_map(fn($data) => $instance->hydrate($data), $results);
    }

    public static function findBy(string $column, mixed $value): array
    {
        $table = static::getTable();
        $instance = new static();
        $sql = "SELECT * FROM {$table} WHERE {$column} = ?";
        if ($instance->softDeletes) {
            $sql .= " AND deleted_at IS NULL";
        }
        $results = Database::fetchAll($sql, [$value]);
        return array_map(fn($data) => $instance->hydrate($data), $results);
    }

    public static function findOneBy(string $column, mixed $value): ?static
    {
        $table = static::getTable();
        $instance = new static();
        $sql = "SELECT * FROM {$table} WHERE {$column} = ?";
        if ($instance->softDeletes) {
            $sql .= " AND deleted_at IS NULL";
        }
        $sql .= " LIMIT 1";
        $data = Database::fetch($sql, [$value]);
        if (!$data) {
            return null;
        }
        return $instance->hydrate($data);
    }

    public function create(array $data): int
    {
        $table = static::getTable();
        $data = $this->filterData($data);
        if ($this->timestamps) {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
        }
        return Database::insert($table, $data);
    }

    public function update(int $id, array $data): bool
    {
        $table = static::getTable();
        $data = $this->filterData($data);
        if ($this->timestamps) {
            $data['updated_at'] = date('Y-m-d H:i:s');
        }
        return Database::update($table, $data, 'id = :id', ['id' => $id]) > 0;
    }

    public static function delete(int $id): bool
    {
        $table = static::getTable();
        $instance = new static();
        if ($instance->softDeletes) {
            return Database::update($table, ['deleted_at' => date('Y-m-d H:i:s')], 'id = :id', ['id' => $id]) > 0;
        }
        return Database::delete($table, 'id = ?', [$id]) > 0;
    }

    public static function forceDelete(int $id): bool
    {
        $table = static::getTable();
        return Database::delete($table, 'id = ?', [$id]) > 0;
    }

    public static function count(): int
    {
        $table = static::getTable();
        $instance = new static();
        $sql = "SELECT COUNT(*) as cnt FROM {$table}";
        if ($instance->softDeletes) {
            $sql .= " WHERE deleted_at IS NULL";
        }
        $result = Database::fetch($sql);
        return (int) ($result['cnt'] ?? 0);
    }

    public static function paginate(int $page = 1, int $perPage = 20): array
    {
        $total = static::count();
        $lastPage = max(1, (int) ceil($total / $perPage));
        $page = max(1, min($page, $lastPage));
        $offset = ($page - 1) * $perPage;
        $items = static::findAll('id ASC', $perPage, $offset);
        return [
            'items' => $items,
            'total' => $total,
            'page' => $page,
            'perPage' => $perPage,
            'lastPage' => $lastPage,
        ];
    }

    public static function with(string|array $relations): static
    {
        $instance = new static();
        $instance->eagerLoads = is_array($relations) ? $relations : [$relations];
        return $instance;
    }

    public static function withTrashed(): static
    {
        $instance = new static();
        $instance->softDeletes = true;
        return $instance;
    }

    public static function onlyTrashed(): array
    {
        $table = static::getTable();
        $instance = new static();
        $sql = "SELECT * FROM {$table} WHERE deleted_at IS NOT NULL";
        $results = Database::fetchAll($sql);
        return array_map(fn($data) => $instance->hydrate($data), $results);
    }

    public static function restore(int $id): bool
    {
        $table = static::getTable();
        return Database::update($table, ['deleted_at' => null], 'id = :id', ['id' => $id]) > 0;
    }

    public function scope(string $method, mixed ...$parameters): static
    {
        $scopeMethod = 'scope' . ucfirst($method);
        if (method_exists($this, $scopeMethod)) {
            $this->{$scopeMethod}(...$parameters);
        }
        return $this;
    }

    protected function filterData(array $data): array
    {
        if (!empty($this->fillable)) {
            return array_intersect_key($data, array_flip($this->fillable));
        }
        if (!empty($this->guarded)) {
            return array_diff_key($data, array_flip($this->guarded));
        }
        return $data;
    }

    protected function hydrate(array $data): static
    {
        $model = new static();
        foreach ($data as $key => $value) {
            $model->$key = $value;
        }
        if (!empty($this->eagerLoads)) {
            foreach ($this->eagerLoads as $relation) {
                $method = 'load' . ucfirst($relation);
                if (method_exists($model, $method)) {
                    $model->$method();
                }
            }
        }
        return $model;
    }
}
