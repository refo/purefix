<?php

// Customer constants
define('CUSTOMER_PATH', realpath(__DIR__.'/purefix'));

define('APP_VERSION', file_exists(__DIR__.'/../VERSION') ? file_get_contents(__DIR__.'/../VERSION') : '');

// Composer autoloader
$loader = require __DIR__.'/vendor/autoload.php';

// Laravel applicaiton
$app = require_once __DIR__.'/laravel-master'.'/bootstrap/app.php';


// Run The Application

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);


$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
