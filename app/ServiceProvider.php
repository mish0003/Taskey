<?php

namespace App;

use App\Controllers\HomeController;
use App\Controllers\TaskController;
use App\Repositories\TaskRepository;
use Framework\ResponseFactory;
use Framework\ServiceContainer;
use Framework\ServiceProviderInterface;
use phpDocumentor\GraphViz\Exception;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @throws Exception
     */
    public function register(ServiceContainer $container): void
    {
        $responseFactory = $container->get(ResponseFactory::class);

        $homeController = new HomeController($responseFactory);
        $container->set(HomeController::class, $homeController);

        $taskRepository = new TaskRepository();
        $taskController = new TaskController($responseFactory, $taskRepository);
        $container->set(TaskController::class, $taskController);
    }
}
