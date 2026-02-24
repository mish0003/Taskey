<?php

namespace Framework;

class Router
{
    public ResponseFactory $responseFactory;

    /** @var Route[]*/
    public array $routes;
    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
        $this->routes = [];
    }

    public function dispatch(Request $request): Response
    {
        $matchedRoute = null;
        $routeParams = [];

        foreach ($this->routes as $route) {
            $matches = $route->matches($request->method, $request->path);

            if ($matches !== false) {
                $matchedRoute = $route;

                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $routeParams[$key] = $value;
                    }
                }
                break;
            }
        }
        if ($matchedRoute !== null) {
            $request->routeParameters = $routeParams;

            $callback = $matchedRoute->callback;

            return $callback($request);
        }
        return $this->responseFactory->notFound();
    }

    public function addRoute(string $method, string $path, callable $callback): void
    {
        $this->routes[] = new Route($method, $path, $callback);
    }
}
