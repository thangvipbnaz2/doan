<?php
namespace App\Models;

use App\Helpers\Database;

abstract class Model
{
    protected static string $table = '';
    protected array $fillable = [];
    protected bool $timestamps = true;

    public static function getTable(): string
    {
        if (static::$table !== '') {
            return static::$table;
        }

        $class = (new \ReflectionClass(static::class))->getShortName();
        $class = str_replace('Model', '', $class);
        $table = preg_replace('/([a-z])([A-Z])/', '$1_$2', $class);
        return strtolower($table) . 's';
    }

    public function getFillable(): array
    {
        return $this->fillable;
    }

    public static function find(int $id): ?static
    {
        $table = static::getTable();
        $data = Database::fetch("SELECT * FROM {$table} WHERE id = ?", [$id]);
        if (!$data) {
            return null;
        }
        $model = new static();
        foreach ($data as $key => $value) {
            $model->$key = $value;
        }
        return $model;
    }

    public static function findAll(string $orderBy = 'id ASC', ?int $limit = null, ?int $offset = null): array
    {
        $table = static::getTable();
        $sql = "SELECT * FROM {$table} ORDER BY {$orderBy}";
        if ($limit !== null) {
            $sql .= " LIMIT {$limit}";
        }
        if ($offset !== null) {
            $sql .= " OFFSET {$offset}";
        }
        return Database::fetchAll($sql);
    }

    public static function findBy(string $column, $value): array
    {
        $table = static::getTable();
        return Database::fetchAll("SELECT * FROM {$table} WHERE {$column} = ?", [$value]);
    }

    public static function findOneBy(string $column, $value): ?static
    {
        $table = static::getTable();
        $data = Database::fetch("SELECT * FROM {$table} WHERE {$column} = ? LIMIT 1", [$value]);
        if (!$data) {
            return null;
        }
        $model = new static();
        foreach ($data as $key => $val) {
            $model->$key = $val;
        }
        return $model;
    }

    public function create(array $data): int
    {
        $table = static::getTable();
        $fillable = $this->getFillable();
        if (!empty($fillable)) {
            $data = array_intersect_key($data, array_flip($fillable));
        }
        if ($this->timestamps) {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
        }
        return Database::insert($table, $data);
    }

    public function update(int $id, array $data): bool
    {
        $table = static::getTable();
        $fillable = $this->getFillable();
        if (!empty($fillable)) {
            $data = array_intersect_key($data, array_flip($fillable));
        }
        if ($this->timestamps) {
            $data['updated_at'] = date('Y-m-d H:i:s');
        }
        return Database::update($table, $data, 'id = :id', ['id' => $id]) > 0;
    }

    public static function delete(int $id): bool
    {
        $table = static::getTable();
        return Database::delete($table, 'id = ?', [$id]) > 0;
    }

    public static function count(): int
    {
        $table = static::getTable();
        $result = Database::fetch("SELECT COUNT(*) as cnt FROM {$table}");
        return (int) ($result['cnt'] ?? 0);
    }

    public static function paginate(int $page = 1, int $perPage = 20): array
    {
        $table = static::getTable();
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
}
