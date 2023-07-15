<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function createUser(UserRequest $userRequest): JsonResponse
    {
        return User::create($userRequest->toArray());
    }
}
