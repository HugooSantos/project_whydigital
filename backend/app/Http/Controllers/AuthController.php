<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\AuthenticationTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;

class AuthController extends Controller
{
    use AuthenticationTrait;

    public function login(AuthRequest $authRequest): object
    {
        return $this->checkCanLogin($authRequest);
    }
}
