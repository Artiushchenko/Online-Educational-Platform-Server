<?php

namespace App\Listeners;

use App\Events\ReportGenerated;

class SendReportGeneratedNotification
{
    public function __construct() {}

    public function handle(ReportGenerated $event): void {}
}
