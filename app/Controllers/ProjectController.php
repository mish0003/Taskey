<?php

namespace App\Controllers;

use App\Models\Project;
use App\Repositories\ProjectRepositoryInterface;
use App\Repositories\TaskRepositoryInterface;
use Framework\Request;
use Framework\Response;
use Framework\ResponseFactory;

class ProjectController
{
    private ResponseFactory $responseFactory;

    private ProjectRepositoryInterface $projectRepository;

    private TaskRepositoryInterface $taskRepository;

    public function __construct(ResponseFactory $responseFactory, ProjectRepositoryInterface $projectRepository, TaskRepositoryInterface $taskRepository)
    {
        $this->responseFactory = $responseFactory;
        $this->projectRepository = $projectRepository;
        $this->taskRepository = $taskRepository;
    }

    public function index(): Response
    {
        $projects = $this->projectRepository->all();
        return $this->responseFactory->view('projects/index.html.twig', [
            'projects' => $projects
        ]);
    }

    public function create(): Response
    {
        return $this->responseFactory->view('projects/create.html.twig');
    }

    public function show(Request $request): Response
    {
        $projectId = (int)$request->get('id');
        $project = $this->projectRepository->find($projectId);
        if (!$project) {
            return $this->responseFactory->notFound();
        }
        $tasks = $this->taskRepository->findProjectTasks($projectId);
        return $this->responseFactory->view('projects/show.html.twig', [
            "project" => $project,
            "tasks" => $tasks
        ]);
    }

    public function store(Request $request): Response
    {
        $title = $request->get('title');
        $description = $request->get('description');

        $errors = [];
        if ($title == null) {
            $errors['title'] = 'Title cannot be blank';
        }

        if ($description == null) {
            $errors['description'] = 'Description cannot be blank';
        }

        $project = new Project();
        $project->title = $title ?? '';
        $project->description = $description ?? '';

        if (!empty($errors)) {
            return $this->responseFactory->view(
                'projects/create.html.twig',
                [
                "project" => $project,
                "errors" => $errors
                ]
            );
        }

        $project = $this->projectRepository->insert($project);

        if (!$project) {
            return $this->responseFactory->internalError();
        }

        return $this->responseFactory->redirect('projects/' . $project->id);
    }

    public function edit(Request $request): Response
    {
        $projectId = (int)$request->get('id');
        $project = $this->projectRepository->find($projectId);
        if (!$project) {
            return $this->responseFactory->notFound();
        }
        return $this->responseFactory->view(
            'projects/edit.html.twig',
            [
            "project" => $project
            ]
        );
    }

    public function update(Request $request): Response
    {
        $projectId = (int)$request->get('id');
        $title = $request->get('title');
        $description = $request->get('description');
        $errors = [];

        if ($title == '') {
            $errors['title'] = 'Title should not be blank';
        }

        if ($description == '') {
            $errors['description'] = 'Description should not be blank';
        }

        $project = $this->projectRepository->find($projectId);
        if (!$project) {
            return $this->responseFactory->internalError();
        }
        $project->title = $title ?? '';
        $project->description = $description ?? '';

        if (!empty($errors)) {
            return $this->responseFactory->view(
                'projects/edit.html.twig',
                [
                    "project" => $project,
                    "errors" => $errors
                ]
            );
        }
        $isProjectUpdated = $this->projectRepository->update($project);
        if (!$isProjectUpdated) {
            return $this->responseFactory->internalError();
        }
        return $this->responseFactory->redirect('/projects/' . $project->id);
    }

    public function confirmDelete(Request $request): Response
    {
        $projectId = (int)$request->get('id');
        $project = $this->projectRepository->find($projectId);
        if (!$project) {
            return $this->responseFactory->notFound();
        }
        return $this->responseFactory->view(
            'projects/delete.html.twig',
            [
            "project" => $project
            ]
        );
    }

    public function delete(Request $request): Response
    {
        $projectId = (int)$request->get('id');
        $project = $this->projectRepository->find($projectId);
        if (!$project) {
            return $this->responseFactory->notFound();
        }
        $isProjectDeleted = $this->projectRepository->delete($project);

        if (!$isProjectDeleted) {
            return $this->responseFactory->internalError();
        }
        return $this->responseFactory->redirect('/projects');
    }
}
