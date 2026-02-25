<?php

namespace Framework;

class Request
{
    public string $method;
    public string $path;
    /** @var string[]*/
    public array $queryParameters;
    /** @var string[]*/
    public array $postParameters;
    /** @var string[]*/
    public array $routeParameters;

    /**
     * @param string $method
     * @param string $path
     * @param string[] $queryParameters
     * @param string[] $postParameters
     */
    public function __construct(
        string $method,
        string $path,
        array $queryParameters,
        array $postParameters,
    ) {
        $this->method = $method;
        $this->path = $path;
        $this->queryParameters = $queryParameters;
        $this->postParameters = $postParameters;
        $this->routeParameters = [];
    }

    /**
     * @param string $key
     * @return string|null
     */
    public function get(string $key): string|null
    {
        //route parameters
        if (isset($this->routeParameters[$key])) {
            return $this->routeParameters[$key];
        }

        //post parameters
        if (isset($this->postParameters[$key])) {
            return $this->postParameters[$key];
        }

        //query parameters
        if (isset($this->queryParameters[$key])) {
            return $this->queryParameters[$key];
        }

        //not found
        return null;
    }
}
