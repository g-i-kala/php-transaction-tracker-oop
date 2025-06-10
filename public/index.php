<?php

declare(strict_types=1);

use App\App;
use App\Config;
use App\Router;
use App\Controllers\HomeController;
use App\Controllers\TransactionsController;
use App\DatabaseInitializer;

require_once __DIR__ . '/../vendor/autoload.php';
require __DIR__ . "/../app/helpers.php";

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

define('STORAGE_PATH', __DIR__ . '/../storage');
define('VIEW_PATH', __DIR__ . '/../views');

$router = new Router();

$router
    ->get('/', [HomeController::class, 'index']);
$router
->get('/transactions', [TransactionsController::class, 'index']);
$router
    ->post('/transactions', [TransactionsController::class, 'store']);

(new App(
    $router,
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
    new Config($_ENV)
))->run();
