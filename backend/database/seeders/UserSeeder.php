<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = $this->getArrayUsersToCreate();
        foreach ($users as $user) {
            User::create([
                "name" => $user['name'],
                "email" => $user['email'],
                "password" => Hash::make($user['password'])
            ]);
        }
    }

    private function getArrayUsersToCreate()
    {
        return [
            [
                "name" => "Eduardo",
                "email" => "eduardo@whydigital.com",
                "password" => "12345678"
            ],
            [
                "name" => "Bruno",
                "email" => "bruno@whydigital.com",
                "password" => "12345678"
            ],
            [
                "name" => "Hugo",
                "email" => "hugo@whydigital.com",
                "password" => "12345678"
            ]
        ];
    }
}
