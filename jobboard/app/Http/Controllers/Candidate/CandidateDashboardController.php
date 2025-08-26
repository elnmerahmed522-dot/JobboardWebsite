<?php
namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class CandidateDashboardController extends Controller
{
    // Dashboard
    public function index()
    {
        $applications = Application::where('user_id', Auth::id())
            ->with('job.company')
            ->latest()
            ->get();

        return view('candidate.dashboard', compact('applications'));
    }

    // صفحة عرض جميع التطبيقات
    public function applications()
    {
        $applications = Application::where('user_id', Auth::id())
            ->with('job.company')
            ->latest()
            ->get();

        return view('candidate.applications.index', compact('applications'));
    }
}
