<?php

namespace App\Http\Services;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Traits\CommonResponseTrait;
use App\Http\Requests\TasksRequest;
use App\Http\Resources\TasksResource;
use Illuminate\Http\JsonResponse;
use App\Models\Tasks;
use Illuminate\Support\Facades\Auth;

class TasksService
{
    use AuthorizesRequests, CommonResponseTrait;

    public function index(): JsonResponse
    {
        $userId = Auth::user()->id;
        $tasks = Tasks::where('user_id_task', $userId)->get();

        if (is_null($tasks->first())) {
            return $this->emptyTaskResponse();
        };

        return response()->json([
            'message' => 'Todas as tasks desse usuário',
            'data' => $tasks->toArray(),
        ], 200);
    }
    public function show(int $taskId): JsonResponse
    {
        $task = Tasks::find($taskId);

        if (is_null($task)) {
            return $this->taskNotFoundResponse($taskId);
        }
        
        $this->authorize('show', $task);

        return $this->sucessResponse(
            'Despesa listada com sucesso.',
            new TasksResource($task),
            200
        );
    }

    public function store(TasksRequest $taskRequest): JsonResponse
    {
        $task = Tasks::create($taskRequest->toArray())
            ->get()
            ->last();

        return $this->sucessResponse(
            'Despesa criada com sucesso',
            new TasksResource($task),
            201
        );
    }

    public function update(TasksRequest $taskRequest, int $taskId): JsonResponse
    {
        $task = Tasks::find($taskId);

        if (is_null($task)) {
            return $this->taskNotFoundResponse($taskId);
        }

        $task->update($taskRequest->toArray());

        return $this->sucessResponse(
            'Despesa atualizada com sucesso',
            new TasksResource($task),
            200
        );
    }

    public function destroy(int $taskId): JsonResponse
    {
        $task = Tasks::find($taskId);

        if (is_null($task)) {
            return $this->taskNotFoundResponse($taskId);
        }

        $task->delete();

        return $this->sucessResponse(
            'Remoção da despesa feita com sucesso.',
            new TasksResource($task),
            200
        );
    }
}
