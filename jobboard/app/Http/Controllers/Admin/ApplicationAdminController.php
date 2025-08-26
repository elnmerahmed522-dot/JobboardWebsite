<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;

class ApplicationAdminController extends Controller
{
    public function index()
    {
        $applications = Application::with(['user', 'job.company'])->latest()->get();
        return view('admin.applications.index', compact('applications'));
    }

    public function destroy(Application $application)
    {
        $application->delete();
        return back()->with('success', 'Application has been deleted successfully.');
    }
}
