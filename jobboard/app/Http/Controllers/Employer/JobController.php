<?php
namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    // عرض كل الوظائف الخاصة بصاحب العمل
    public function index()
    {
        $jobs = Job::where('company_id', Auth::user()->company->id)
                   ->latest()
                   ->paginate(10);

      return view('employer.applications.jobs.index', compact('jobs'));

    }
}