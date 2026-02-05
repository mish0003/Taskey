<?php

namespace App;

use App\Controllers\HomeController;
use App\Controllers\TaskController;
use Framework\RouteProviderInterface;
use Framework\Router;

class RouteProvider implements RouteProviderInterface
{
    public function register(Router $router): void
    {
        $homeController = new HomeController();

        $router->addRoute('GET', '/', [$homeController, 'index']);
        $router->addRoute('GET', '/about', [$homeController, 'about']);

        $taskController = new TaskController();
        $router->addRoute('GET', '/tasks', [$taskController, 'index']);
        $router->addRoute('GET', '/tasks/create', [$taskController, 'create']);
    }
}
