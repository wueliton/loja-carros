<?php

use Illuminate\Http\Request;

$host = $_SERVER['HTTP_HOST'];

$BASE_PATH = '/../../sistema';

if (str_contains($host, 'localhost')) {
    $BASE_PATH = '/..';
}

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__ . $BASE_PATH . '/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__ . $BASE_PATH . '/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__ . $BASE_PATH . '/bootstrap/app.php')
    ->usePublicPath(__DIR__)
    ->handleRequest(Request::capture());
