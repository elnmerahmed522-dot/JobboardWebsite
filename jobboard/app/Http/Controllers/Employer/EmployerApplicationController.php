<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployerApplicationController extends Controller
{
    /**
     * عرض كل الوظائف الخاصة بالشركة الحالية (My Jobs)
     */
    public function jobs()
    {
        $company = Auth::user()->company;

        $jobs = $company->jobs()->latest()->paginate(10);

        return view('employer.applications.jobs.index', compact('jobs'));
    }

    /**
     * عرض كل الطلبات الخاصة بكل وظائف الشركة
     */
    public function allApplications()
    {
        $company = Auth::user()->company;

        $applications = Application::whereIn('job_id', $company->jobs()->pluck('id'))
                                   ->with('user.profile', 'job')
                                   ->latest()
                                   ->paginate(10);

        return view('employer.applications.all', compact('applications'));
    }

    /**
     * عرض الطلبات الخاصة بوظيفة معينة
     */
    public function jobApplications(Job $job)
    {
        // تحميل العلاقة مع الشركة
        $job->load('company');

        // تأكد أن الوظيفة تخص صاحب الحساب الحالي
        if (!$job->company || $job->company->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $applications = $job->applications()
                            ->with('user.profile')
                            ->latest()
                            ->paginate(10);

        return view('employer.applications.jobs.applications', compact('job', 'applications'));

    }

    /**
     * تحديث حالة طلب (اختياري لو كنت تستخدمه)
     */
    public function updateStatus(Application $application, Request $request)
    {
$request->validate([
    'status' => 'required|in:pending,accepted,rejected',
]);


        $application->status = $request->status;
        $application->save();

        return redirect()->back()->with('success', 'Application status updated.');
    }
}
