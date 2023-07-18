<?php

namespace App\Http\Services;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Traits\CommonResponseTrait;
use App\Http\Requests\TasksRequest;
use App\Http\Resources\TasksResource;
use Illuminate\Http\JsonResponse;
use App\Models\Tasks;
use Illuminate\Database\Eloquent\Collection;
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

        $tasksToResponse = $this->getArrayOfResourcesTasks($tasks);

        return response()->json([
            'message' => 'Todas as tasks desse usuário',
            'data' => $tasksToResponse,
        ], 200);
    }

    private function getArrayOfResourcesTasks(Collection $tasks): array
    {
        $arrayResorces = array();
        foreach ($tasks as $task) {
            $arrayResorces[] = new TasksResource($task);
        }
        return $arrayResorces;
    }
    public function show(int $taskId): JsonResponse
    {
        $task = Tasks::find($taskId);

        if (is_null($task)) {
            return $this->taskNotFoundResponse($taskId);
        }

        $this->authorize('show', $task);

        return $this->sucessResponse(
            'Tarefa listada com sucesso.',
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
            'Tarefa criada com sucesso',
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
        $this->authorize('update', $task);

        $task->update($taskRequest->toArray());

        return $this->sucessResponse(
            'Tarefa atualizada com sucesso',
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

        $this->authorize('delete', $task);

        $task->delete();

        return $this->sucessResponse(
            'Remoção da tarefa feita com sucesso.',
            new TasksResource($task),
            200
        );
    }
}
