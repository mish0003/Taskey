<?php

namespace Framework;

use phpDocumentor\GraphViz\Exception;

class ServiceContainer
{
    /** @var array<class-string, object>*/
    private array $instances = [];

    /**
     * @template T of object
     * @param class-string<T> $id
     * @param object $instance
     * @return void
     * @throws Exception
     */
    public function set(string $id, object $instance): void
    {
        if (isset($this->instances[$id])) {
            throw new Exception('Target already exists');
        }
        $this->instances[$id] = $instance;
    }

    /**
     * @template T of object
     * @param class-string<T> $id
     * @return T
     * @throws Exception
     */
    public function get(string $id): object
    {
        if (!isset($this->instances[$id])) {
            throw new Exception('Target not found ' . $id);
        }
        /** @var T */
        return $this->instances[$id];
    }
}
