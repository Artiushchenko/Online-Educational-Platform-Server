<?php

namespace App\Providers;

use App\Services\CategoryService;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CategoryService::class, function () {
            return new CategoryService();
        });
    }
}
