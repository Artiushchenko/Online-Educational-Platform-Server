<?php

namespace App\Providers;

use App\Events\NewChatMessage;
use App\Events\ReportGenerated;
use App\Listeners\SendChatMessageNotification;
use App\Listeners\SendReportGeneratedNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        NewChatMessage::class => [
            SendChatMessageNotification::class
        ],
        ReportGenerated::class => [
            SendReportGeneratedNotification::class
        ]
    ];

    public function boot(): void {}

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
