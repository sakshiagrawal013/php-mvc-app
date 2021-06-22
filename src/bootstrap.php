<?php
require 'vendor/autoload.php';
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ALL);
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

session_start();


// Load Config
require_once 'config/config.php';

//dependency injection code

$container = new League\Container\Container;

$container->add(App\Controllers\UserController::class)->addArgument(new App\Models\User);