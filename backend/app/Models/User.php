<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes; 
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

    public function getJWTIdentifier() 
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Tasks::class);
    }
}
