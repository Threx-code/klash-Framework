<?php
/**
 * class Application
 *
 * @package Klash 
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@skopos.io>
 */


if (file_exists(__DIR__.'/../vendor/autoload.php')) {
	require_once __DIR__.'/../vendor/autoload.php';
}

use App\Core\Application;
use App\Controllers\HomeController;
use App\Controllers\ContactController;
use App\Controllers\LoginController;
use App\Controllers\RegisterController;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
	'db'=>[
		'dsn' => $_ENV['DB_DSN'],
		'user' => $_ENV['DB_USERNAME'],
		'password' => $_ENV['DB_PASS']
	]
];


$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [HomeController::class, 'index']);

$app->router->get('/contact', [ContactController::class, 'index']);
$app->router->post('/contact', [ContactController::class, 'handleContact']);


$app->router->get('/login', [LoginController::class, 'index']);
$app->router->post('/login', [LoginController::class, 'store']);


$app->router->get('/register', [RegisterController::class, 'index']);
$app->router->post('/register', [RegisterController::class, 'store']);

$app->run();