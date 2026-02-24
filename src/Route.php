<?php

namespace Framework;

class Route
{
    public string $method;
    public string $path;
    /** @var callable*/
    public $callback;

    /** @var string[]*/
    public array $routeParameters;
    public function __construct(string $method, string $path, callable $callback)
    {
        $this->method = $method;
        $this->path = $path;
        $this->callback = $callback;
        $this->routeParameters = [];
    }

    /**
     * @param string $method
     * @param string $path
     * @return string[]|false
     */
    public function matches(string $method, string $path): array|false
    {
        if ($this->method !== $method) {
            return false;
        }

        $regex = "#^" . $this->path . "$#";

        if (preg_match($regex, $path, $matches)) {
            return $matches;
        }

        return false;
    }
}
