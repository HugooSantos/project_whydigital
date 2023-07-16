<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\TasksPolicy;
use App\Models\Tasks;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Tasks::class => TasksPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
