<?php

namespace App;

use App\Controllers\HomeController;
use App\Controllers\ProjectController;
use App\Controllers\TaskController;
use App\Repositories\ProjectRepository;
use App\Repositories\TaskRepository;
use Framework\Database;
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

        $database = $container->get(Database::class);

        $taskRepository = new TaskRepository($database);
        $projectRepository = new ProjectRepository($database);

        $homeController = new HomeController($responseFactory);
        $container->set(HomeController::class, $homeController);

        $taskController = new TaskController($responseFactory, $taskRepository, $projectRepository);
        $container->set(TaskController::class, $taskController);

        $projectController = new ProjectController($responseFactory, $projectRepository, $taskRepository);
        $container->set(ProjectController::class, $projectController);
    }
}
