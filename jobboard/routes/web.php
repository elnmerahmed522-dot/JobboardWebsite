<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ApplicationController;
use App\Models\Job;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\JobAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\CompanyAdminController;
use App\Http\Controllers\Admin\ApplicationAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Employer\EmployerDashboardController;
use App\Http\Controllers\Candidate\CandidateDashboardController;
use App\Http\Controllers\Candidate\CandidateProfileController;
use App\Http\Controllers\Employer\EmployerApplicationController;
use App\Http\Controllers\JobBoardController;
use App\Http\Controllers\Employer\JobApplicationController;
use App\Http\Controllers\Admin\ReportController;



Route::get('/', function () {
    $latestJobs = Job::where('status', 'approved')
                     ->with('company')
                     ->latest()
                     ->take(5)
                     ->get();
    return view('frontend.home', compact('latestJobs'));
})->name('home');

// Dashboard عام
Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Jobs عامة
Route::get('jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

// Companies عامة
Route::get('companies/{company}', [CompanyController::class, 'show'])->name('companies.show');


// ================= Admin Routes =================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Users
        Route::resource('users', UserAdminController::class)->except(['create','store','show']);
        
        // Companies
        Route::resource('companies', CompanyAdminController::class)->except(['create','store','show']);
        
        // Jobs
        Route::get('jobs', [JobAdminController::class, 'index'])->name('jobs.index');
        Route::post('jobs/{job}/approve', [JobAdminController::class, 'approve'])->name('jobs.approve');
        Route::post('jobs/{job}/reject', [JobAdminController::class, 'reject'])->name('jobs.reject');
        Route::delete('jobs/{job}', [JobAdminController::class, 'destroy'])->name('jobs.destroy');
        
        // Applications
        Route::get('applications', [ApplicationAdminController::class, 'index'])->name('applications.index');
        Route::delete('applications/{application}', [ApplicationAdminController::class, 'destroy'])->name('applications.destroy');
        
        // Reports
        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
});
// ================= Employer Routes =================
Route::middleware(['auth', 'role:employer'])
    ->prefix('employer')
    ->name('employer.')
    ->group(function () {
        // Dashboard
        Route::get('dashboard', [EmployerDashboardController::class, 'index'])->name('dashboard');

        // CRUD للوظائف
        Route::resource('jobs', JobController::class)->except(['show']);

        // Companies CRUD (بدون index)
        Route::resource('companies', CompanyController::class)->except(['index']);

        // Applications
        // كل الطلبات لكل وظائف الشركة
        Route::get('applications', [EmployerApplicationController::class, 'allApplications'])
             ->name('applications.index');

        // تحديث حالة طلب
        Route::put('applications/{application}/status', [EmployerApplicationController::class, 'updateStatus'])
             ->name('applications.updateStatus');

        // My Jobs (كل الوظائف الخاصة بالشركة)
        Route::get('applications/jobs', [EmployerApplicationController::class, 'jobs'])
             ->name('applications.jobs.index');

        // Applications الخاصة بوظيفة محددة
        Route::get('jobs/{job}/applications', [EmployerApplicationController::class, 'jobApplications'])
             ->name('jobs.applications'); // بدون "employer." هنا

    });


// ================= Candidate Routes =================
Route::middleware(['auth','role:candidate'])
    ->prefix('candidate')
    ->name('candidate.')
    ->group(function () {
        Route::get('dashboard', [CandidateDashboardController::class, 'index'])->name('dashboard');

        Route::get('profile', [CandidateProfileController::class, 'showSelf'])->name('profile.show');
        Route::get('profile/edit', [CandidateProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [CandidateProfileController::class, 'update'])->name('profile.update');

        // Applications
        Route::get('applications', [CandidateDashboardController::class, 'applications'])->name('applications.index');
        Route::post('jobs/{job}/apply', [ApplicationController::class, 'store'])->name('applications.store');
});


// Public profile view
Route::get('profiles/{user}', [CandidateProfileController::class, 'showPublic'])->name('profiles.public');

require __DIR__.'/auth.php';
