<?php

namespace App\Http\Services;

use App\Models\Tasks;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TasksService
{
    use AuthorizesRequests;

    public function show(int $taskId)
    {
        Tasks::find($taskId);
    }

    public function store($taskRequest)
    {
        
    }

    public function update($taskRequest, int $taskId)
    {

    }

    public function destroy(int $taskId)
    {

    }

    public function index()
    {
        return Tasks::all();
    }
}
