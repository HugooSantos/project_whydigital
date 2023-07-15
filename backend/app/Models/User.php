<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static function create(array $user): object
    {   
        self::insert($user);
        return self::getSucessUserCreateResponse();
    }

    private static function getSucessUserCreateResponse(): object
    {
        return response()->json([
            'status' => 'Sucesso',
            'message' => 'Criação do usuário feita com sucesso',
        ], 201);
    }
}
