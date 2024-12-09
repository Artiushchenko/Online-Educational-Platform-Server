<?php

namespace App\Jobs;

use App\Events\ReportGenerated;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class GenerateUserReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public int $userId
    ) {}

    public function handle(): void
    {
        $user = User::find($this->userId);

        $viewedLectures = $user->viewedLectures()->pluck('title');

        $data = [
            'user' => $user->name,
            'email' => $user->email,
            'viewedLectures' => $viewedLectures,
        ];

        $pdf = Pdf::loadView('reports.user_statistics', $data);
        $fileName = "{$user->name}_report.pdf";
        $filePath = "public/reports/{$fileName}";

        Storage::disk('local')->put($filePath, $pdf->output());

        broadcast(new ReportGenerated($this->userId, $fileName));
    }
}
