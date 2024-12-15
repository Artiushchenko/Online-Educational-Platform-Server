<?php

namespace App\Providers;

use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserService::class, function () {
            return new UserService();
        });
    }
}
