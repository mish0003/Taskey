<?php

namespace Framework;

class Router
{
    /** @var Route[]*/
    public array $routes;
    public function __construct()
    {
    }

    public function dispatch(Request $request): Response
    {
        $matchedRoute = null;
        foreach ($this->routes as $route) {
            if ($route->matches($request->method, $request->path)) {
                $matchedRoute = $route;
                break;
            }
        }
        if (!$matchedRoute) {
            return new Response("Page not found", 404);
        }
        $callback = $matchedRoute->callback;
        $response = $callback();
        return $response;
    }

    public function addRoute(string $method, string $path, callable $callback): void
    {
        $this->routes[] = new Route($method, $path, $callback);
    }
}
