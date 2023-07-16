<?php

namespace App\Http\Controllers;

use App\Http\Services\TasksService;

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

    public function show(int $taskId)
    {   
        die('a');
    }

    public function store($tastkRequest)
    {  
        die('b');
    }

    public function update($taskRequest, int $taskId)
    {
        die('c');
    }

    public function destroy(int $taskId)
    {
        die('d');
    }
}
