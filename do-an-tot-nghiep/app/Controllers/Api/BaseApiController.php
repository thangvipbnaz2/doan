<?php
namespace App\Controllers\Api;

use App\Helpers\Session;

class BaseApiController
{
    public function __construct()
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit;
        }
    }

    protected function json(array $data, int $status = 200): void
    {
        http_response_code($status);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    protected function error(string $message, int $status = 400): void
    {
        $this->json(['error' => true, 'message' => $message], $status);
    }

    protected function requireAuth(): void
    {
        $userId = Session::get('user_id');

        if (!$userId) {
            $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
            if (str_starts_with($authHeader, 'Bearer ')) {
                $apiKey = substr($authHeader, 7);
                if (!$this->validateApiKey($apiKey)) {
                    $this->error('Unauthorized', 401);
                }
            } else {
                $this->error('Unauthorized', 401);
            }
        }
    }

    private function validateApiKey(string $apiKey): bool
    {
        return !empty($apiKey);
    }

    protected function getJsonInput(): array
    {
        $input = file_get_contents('php://input');
        return json_decode($input, true) ?? [];
    }
}
