<?php

namespace Framework;

use phpDocumentor\GraphViz\Exception;

class Kernel
{
    private Router $router;
    private ServiceContainer $serviceContainer;

    private ConfigManager $configManager;

    /**
     * @param string[] $config
     * @throws Exception
     * @throws \Exception
     */
    public function __construct(array $config)
    {
        $this->serviceContainer = new ServiceContainer();

        $this->configManager = new ConfigManager($config);

        $debugMode = $this->configManager->get('APP_ENV') != 'production';
        $viewsPath = $this->configManager->get('VIEWS_PATH');
        $responseFactory = new ResponseFactory($debugMode, $viewsPath);

        $this->serviceContainer->set(ResponseFactory::class, $responseFactory);

        $this->router = new Router($responseFactory);
    }

    public function registerRoutes(RouteProviderInterface $routeProvider): void
    {
        $routeProvider->register($this->router, $this->serviceContainer);
    }
    public function registerServices(ServiceProviderInterface $serviceProvider): void
    {
        $serviceProvider->register($this->serviceContainer);
    }

    public function handle(Request $request): Response
    {
        return $this->router->dispatch($request);
    }
}
