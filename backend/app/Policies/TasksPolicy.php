<?php

namespace App\Policies;

use App\Http\Controllers\Traits\CommonResponseTrait;
use Illuminate\Auth\Access\Response;
use App\Models\Tasks;
use App\Models\User;

class TasksPolicy
{
    use CommonResponseTrait;

    public function create(): bool
    {
        return true;
    }

    public function show(User $userModel, Tasks $taskModel): Response
    {
        return $this->checkUserCanOperate($userModel->id, $taskModel->user_id_task);
    }

    public function update(User $userModel, Tasks $taskModel): Response
    {
        return $this->checkUserCanOperate($userModel->id, $taskModel->user_id_task);
    }

    public function delete(User $userModel, Tasks $taskModel): Response
    {
        return $this->checkUserCanOperate($userModel->id, $taskModel->user_id_task);
    }

    private function checkUserCanOperate(int $userId, int $expenseUserId): Response
    {
        return $userId == $expenseUserId
            ? Response::allow()
            : Response::deny('Usuário não autorizado a operar essa despesa.', 403);
    }
}
