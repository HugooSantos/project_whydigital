<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest;

trait AuthenticationTrait
{

    protected function checkCanLogin(AuthRequest $authRequest): object
    {
        $credentials = $authRequest->toArray();
        $token = Auth::attempt($credentials);

        if ($token) {
            return $this->getAuthenticatedResponse($token);
        }

        return $this->getFailedAuthenticatedResponse();
    }

    private function getAuthenticatedResponse(string $token): object
    {
        return response()->json([
            'status' => 'Autenticado',
            'auth' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    private function getFailedAuthenticatedResponse(): object
    {
        return response()->json([
            'status' => 'error',
            'message' => 'Falha ao Autenticar',
        ], 401);
    }
}
