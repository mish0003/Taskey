<?php

 require __DIR__ . '/../vendor/autoload.php';

 use Framework\Kernel;
 use Framework\Request;

 echo "Hello world! ";

 $kernel = new Kernel();

 $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (!is_string($urlPath)) {
    $urlPath = "/";
}
 $request = new Request($_SERVER['REQUEST_METHOD'], $urlPath, $_GET, $_POST);

 $response = $kernel->handle($request);

 $response->echo();
