<?php

namespace App\Models;

class Task
{
    public int $id;

    public string $title;

    public string $description;

    public int $priority;

    public int $status;

    public int $progress;

    public int $createdAt;

    public ?int $completedAt;
}
