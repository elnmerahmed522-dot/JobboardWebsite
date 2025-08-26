<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use App\Models\Job;
use App\Models\Application;

class ReportController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalCompanies = Company::count();
        $totalJobs = Job::count();
        $totalApplications = Application::count();

        // توزيع المستخدمين حسب النوع (role)
        $usersByRole = User::select('role', \DB::raw('count(*) as total'))
            ->groupBy('role')
            ->pluck('total', 'role');

        // عدد الوظائف المنشورة كل شهر (آخر 6 شهور)
        $jobsByMonth = Job::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->pluck('total', 'month');

        return view('admin.reports.index', compact(
            'totalUsers', 'totalCompanies', 'totalJobs', 'totalApplications',
            'usersByRole', 'jobsByMonth'
        ));
    }
}