<?php

 require __DIR__ . '/../vendor/autoload.php';

use App\RouteProvider;
use Framework\Kernel;
use Framework\Request;

 $kernel = new Kernel();
 $routeProvider = new RouteProvider();
 $kernel->registerRoutes($routeProvider);

 $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (!is_string($urlPath)) {
    $urlPath = "/";
}
 $request = new Request($_SERVER['REQUEST_METHOD'], $urlPath, $_GET, $_POST);

 $response = $kernel->handle($request);

 $response->echo();
