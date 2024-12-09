<?php

namespace App\Listeners;

use App\Events\NewChatMessage;

class SendChatMessageNotification
{
    public function __construct() {}

    public function handle(NewChatMessage $event): void {}
}
