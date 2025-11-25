<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Maintenance mode
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Composer autoload
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__.'/../bootstrap/app.php';

// Force HTTPS if on production (Railway serves HTTPS)
if (env('APP_ENV') === 'production') {
    $_SERVER['HTTPS'] = 'on';
}

// Handle the request and send the response
$request = Request::capture();
$response = $app->handle($request);

// Send response headers and content
$response->send();

// Terminate the application (for middleware, logging, etc.)
$app->terminate($request, $response);
