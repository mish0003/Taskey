<?php

namespace App\Repositories;

use App\Models\Task;

interface TaskRepositoryInterface
{
    /**
     * @return Task[]
    */
    public function all(): array;

    public function find(int $id): ?Task;

    public function insert(Task $task): ?Task;

    public function update(Task $task): bool;

    public function delete(Task $task): bool;

    /**
     * @return Task[]
     */
    public function findProjectTasks(int $id): array;
}
