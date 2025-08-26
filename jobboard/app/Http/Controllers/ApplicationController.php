<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewJobApplication;
use App\Notifications\ApplicationStatusChanged;

class ApplicationController extends Controller
{

    public function index(Job $job)
    {

        if ($job->company->user_id !== Auth::id()) {
            abort(403);
        }

        $applications = $job->applications()->with('user')->get();
        return view('applications.index', compact('applications', 'job'));
    }
public function store(Request $request, Job $job)
{
    $request->validate([
        'cv' => 'nullable|mimes:pdf,doc,docx|max:2048',
    ]);

    $cvPath = null;
    if ($request->hasFile('cv')) {
        $cvPath = $request->file('cv')->store('cvs', 'public');
    }

    $application = Application::create([
        'job_id' => $job->id,
        'user_id' => Auth::id(),
        'cv' => $cvPath,
        'status' => 'pending',
    ]);

    // إرسال إشعار لصاحب الشركة
    $job->company->user->notify(new NewJobApplication($job));

    return back()->with('success', 'The job has been successfully applied for.');
}



public function accept(Application $application)
{
    $this->authorizeEmployer($application);
    $application->update(['status' => 'accepted']);
    $application->user->notify(new ApplicationStatusChanged($application));
    return back()->with('success', 'The applicant has been accepted.');
}

public function reject(Application $application)
{
    $this->authorizeEmployer($application);
    $application->update(['status' => 'rejected']);
    $application->user->notify(new ApplicationStatusChanged($application));
    return back()->with('success', 'The applicant was rejected.');
}
   


  
    private function authorizeEmployer(Application $application)
    {
        if ($application->job->company->user_id !== Auth::id()) {
            abort(403);
        }
    }
}