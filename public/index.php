<?php

 require __DIR__ . '/../vendor/autoload.php';

use App\RouteProvider;
use App\ServiceProvider;
use Framework\Kernel;
use Framework\Request;

$config = array(
    'APP_ENV' => 'development',
    'VIEWS_PATH' => 'app/views'
);
 $kernel = new Kernel($config);

 $serviceProvider = new ServiceProvider();
 $kernel->registerServices($serviceProvider);

 $routeProvider = new RouteProvider();
 $kernel->registerRoutes($routeProvider);

 $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (!is_string($urlPath)) {
    $urlPath = "/";
}
 $request = new Request($_SERVER['REQUEST_METHOD'], $urlPath, $_GET, $_POST);

 $response = $kernel->handle($request);

 $response->echo();
