<?php

namespace App\Providers;

use App\Services\ChatService;
use Illuminate\Support\ServiceProvider;

class ChatServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ChatService::class, function () {
            return new ChatService();
        });
    }
}
