<?php
/**
 * class Application
 *
 * @package Klash 
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@skopos.io>
 */


if (file_exists(__DIR__.'/vendor/autoload.php')) {
	require_once __DIR__.'/vendor/autoload.php';

}

use App\Core\Application;


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
	'db'=>[
		'dsn' => $_ENV['DB_DSN'],
		'user' => $_ENV['DB_USERNAME'],
		'password' => $_ENV['DB_PASS']
	]
];


$app = new Application(__DIR__, $config);

$app->db->applyMigration();