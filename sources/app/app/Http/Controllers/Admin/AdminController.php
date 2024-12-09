<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminService;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct(
        protected AdminService $adminService
    ) {}

    public function index(): View
    {
        return view('admin.show.welcome');
    }

    public function getStatistics(): View
    {
        $statistics = $this->adminService->getStatistics();

        return view('admin.show.statistics', $statistics);
    }
}
