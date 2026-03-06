<?php

namespace App\Repositories;

use App\Models\Project;

interface ProjectRepositoryInterface
{
    /**
     * @return Project[]
     */
    public function all(): array;

    public function find(int $id): ?Project;

    public function insert(Project $project): ?Project;

    public function update(Project $project): bool;

    public function delete(Project $project): bool;
}