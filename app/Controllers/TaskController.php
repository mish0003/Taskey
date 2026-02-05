<?php

namespace App\Controllers;

use Framework\Response;

class TaskController
{
    public function index(): Response
    {
        return new Response('Listing all the tasks');
    }
    public function create(): Response
    {
        return new Response('Creating task');
    }
}
