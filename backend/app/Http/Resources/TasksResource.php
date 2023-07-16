<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TasksResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id_task,
            'description' => $this->description_task,
            'complete' => $this->complete_task,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
