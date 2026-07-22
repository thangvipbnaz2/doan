<?php
namespace App\Controllers\Frontend;

use App\Controllers\Controller;
use App\Helpers\View;

class HomeController extends Controller
{
    public function index(): void
    {
        $basePath = View::baseUrl();

        $levels = [
            'HSK1' => ['name' => 'HSK 1', 'count' => 150, 'icon' => '🌱'],
            'HSK2' => ['name' => 'HSK 2', 'count' => 300, 'icon' => '🌿'],
            'HSK3' => ['name' => 'HSK 3', 'count' => 600, 'icon' => '🌳'],
            'HSK4' => ['name' => 'HSK 4', 'count' => 1200, 'icon' => '🌲'],
            'HSK5' => ['name' => 'HSK 5', 'count' => 2500, 'icon' => '🏔️'],
            'HSK6' => ['name' => 'HSK 6', 'count' => 5000, 'icon' => '🏯'],
        ];

        $this->view('frontend/home', [
            'levels' => $levels,
            'basePath' => $basePath,
        ]);
    }
}
