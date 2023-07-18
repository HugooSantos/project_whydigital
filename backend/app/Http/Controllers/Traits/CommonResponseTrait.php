<?php

namespace App\Http\Controllers\Traits;

use App\Http\Resources\TasksResource;
use Illuminate\Http\JsonResponse;

trait CommonResponseTrait
{
    protected function sucessResponse(string $message, TasksResource $data, int $code): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    protected function taskNotFoundResponse(int $tasksId): JsonResponse
    {
        return response()->json([
            'message' => 'task de ID: ' . $tasksId
                . ' não encontrada.'
        ], 404);
    }

    protected function emptyTaskResponse(): JsonResponse
    {
        return response()->json([
            'message' => 'Nenhuma task cadastrada ainda pra esse usuário',
            "data" => []
        ], 404);
    }
}
