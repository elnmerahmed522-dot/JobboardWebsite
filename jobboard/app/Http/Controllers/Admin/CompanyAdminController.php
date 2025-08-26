<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyAdminController extends Controller
{
    public function index()
    {
        $companies = Company::with('user')->latest()->get();
        return view('admin.companies.index', compact('companies'));
    }

    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'website' => 'nullable|url',
            'description' => 'nullable',
        ]);

        $company->update($request->only(['name', 'website', 'description']));
        return redirect()->route('admin.companies.index')->with('success', 'Company information has been updated successfully.');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return back()->with('success', 'Company has been deleted successfully.');
    }
}

