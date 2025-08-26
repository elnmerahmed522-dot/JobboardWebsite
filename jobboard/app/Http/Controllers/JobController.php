<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JobController extends Controller
{
    use AuthorizesRequests; // لو عايز تستخدم authorize لاحقًا

public function index(Request $request)
{
    $query = Job::where('status', 'approved')->with('company');

    // Search by keyword (job title or company name)
    if ($request->filled('keyword')) {
        $keyword = $request->keyword;
        $query->where(function ($q) use ($keyword) {
            $q->where('title', 'LIKE', "%{$keyword}%")
              ->orWhereHas('company', function ($q2) use ($keyword) {
                  $q2->where('name', 'LIKE', "%{$keyword}%");
              });
        });
    }

    // Filter by location
    if ($request->filled('location')) {
        $query->where('location', $request->location);
    }

    // Filter by type
    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

    // Filter by min salary
    if ($request->filled('min_salary')) {
        $query->where('salary', '>=', $request->min_salary);
    }

    // Use pagination instead of get()
    $jobs = $query->latest()->paginate(10)->withQueryString();

    // For filters dropdowns
    $locations = Job::select('location')->distinct()->pluck('location');
    $types = Job::select('type')->distinct()->pluck('type');

    return view('jobs.index', compact('jobs', 'locations', 'types'));
}

    public function show(Job $job)
    {
       return view('frontend.jobs.show', compact('job'));

    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'type' => 'required',
            'salary' => 'nullable|numeric',
        ]);

        $company = Company::where('user_id', Auth::id())->first();

        Job::create([
            'company_id' => $company->id,
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'type' => $request->type,
            'salary' => $request->salary,
            'status' => 'pending',
        ]);

        return redirect()->route('employer.jobs.index')
                         ->with('success', 'The job has been created and is awaiting admin approval.');
    }

    public function edit(Job $job)
    {
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'type' => 'required',
            'salary' => 'nullable|numeric',
        ]);

        $job->update($request->all());

        return redirect()->route('employer.jobs.index')
                         ->with('success', 'The job has been modified.');
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()->route('employer.jobs.index')
                         ->with('success', 'The job has been deleted.');
    }
}
