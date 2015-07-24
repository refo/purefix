<?php

$loader = require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/laravel-master'.'/bootstrap/app.php';

// Run The Application

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
