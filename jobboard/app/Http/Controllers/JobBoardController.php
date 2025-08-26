<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobBoardController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::with('company')
            ->where('status', 'approved');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
        }

        $jobs = $query->latest()->paginate(5);

        return view('frontend.jobs.index', compact('jobs'));
    }

    public function show(Job $job)
    {
        if ($job->status !== 'approved') {
            abort(404);
        }

        return view('frontend.jobs.show', compact('job'));
    }
}
