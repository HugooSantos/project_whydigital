<?php

namespace App\Http\Controllers;

use App\Http\Requests\TasksRequest;
use App\Http\Services\TasksService;
use Illuminate\Http\JsonResponse;

class TasksController extends Controller
{

    protected $taskService;

    public function __construct()
    {
        $this->taskService = new TasksService();
    }

    public function index()
    {
        return $this->taskService->index();
    }

    public function show(int $taskId): JsonResponse
    {
        return $this->taskService->show($taskId);
    }

    public function store(TasksRequest $tastkRequest): JsonResponse
    {
        return $this->taskService->store($tastkRequest);
    }

    public function update(TasksRequest $taskRequest, int $taskId): JsonResponse
    {
        return $this->taskService->update($taskRequest, $taskId);
    }

    public function destroy(int $taskId): JsonResponse
    {
        return $this->taskService->destroy($taskId);
    }
}
