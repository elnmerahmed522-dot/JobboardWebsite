<?php
namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class EmployerDashboardController extends Controller
{
    public function index()
    {
        // نجيب الوظائف الخاصة بالشركة بتاعة الـ Employer الحالي
        $jobs = Job::whereHas('company', function($q) {
            $q->where('user_id', Auth::id());
        })->withCount('applications')->latest()->get();

        return view('employer.dashboard', compact('jobs'));
    }
}
