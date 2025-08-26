<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;

class JobAdminController extends Controller
{
    public function index()
    {
        $jobs = Job::with('company.user')->latest()->get();
        return view('admin.jobs.index', compact('jobs'));
    }

    public function approve(Job $job)
    {
        $job->update(['status' => 'approved']);
        return back()->with('success', 'The job has been approved.');
    }

    public function reject(Job $job)
    {
        $job->update(['status' => 'rejected']);
        return back()->with('success', 'The job was rejected.');
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return back()->with('success', 'The job has been deleted.');
    }
}