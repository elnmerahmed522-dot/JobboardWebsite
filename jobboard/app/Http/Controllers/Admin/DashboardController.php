<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use App\Models\Job;
use App\Models\Application;

class DashboardController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $adminsCount = User::role('admin')->count();
        $employersCount = User::role('employer')->count();
        $candidatesCount = User::role('candidate')->count();

        $companiesCount = Company::count();

        $jobsCount = Job::count();
        $jobsPending = Job::where('status', 'pending')->count();
        $jobsApproved = Job::where('status', 'approved')->count();
        $jobsRejected = Job::where('status', 'rejected')->count();

        $applicationsCount = Application::count();

        return view('admin.dashboard', compact(
            'usersCount', 'adminsCount', 'employersCount', 'candidatesCount',
            'companiesCount',
            'jobsCount', 'jobsPending', 'jobsApproved', 'jobsRejected',
            'applicationsCount'
        ));
    }
}