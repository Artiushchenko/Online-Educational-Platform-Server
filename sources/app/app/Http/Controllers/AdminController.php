<?php

namespace app\Http\Controllers;

use App\Services\AdminService;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct(
        protected AdminService $adminService
    ) {}

    public function welcome(): View
    {
        return view('admin.show.welcome');
    }

    public function showStatistics(): View
    {
        $statistics = $this->adminService->showStatistics();

        return view('admin.show.statistics', $statistics);
    }
}
