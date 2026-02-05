<?php

namespace Framework;

class Route
{
    public string $method;
    public string $path;
    /** @var callable*/
    public $callback;
    public function __construct(string $method, string $path, callable $callback)
    {
        $this->method = $method;
        $this->path = $path;
        $this->callback = $callback;
    }
    public function matches(string $method, string $path): bool
    {
        return $this->method === $method && $this->path === $path;
    }
}
