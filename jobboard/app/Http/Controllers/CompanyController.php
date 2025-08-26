<?php
namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{

  
public function show(Company $company)
{
    // Get approved jobs for this company
    $jobs = $company->jobs()
        ->where('status', 'approved')
        ->latest()
        ->paginate(5);

    return view('companies.show', compact('company', 'jobs'));
}
   
    public function create()
    {
        return view('companies.create');
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'website' => 'nullable|url',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'description' => 'nullable',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        Company::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'website' => $request->website,
            'logo' => $logoPath,
            'description' => $request->description,
        ]);

        return redirect()->route('companies.show', Auth::user()->company->id)
                         ->with('success', 'The company has been added successfully.');
    }


    public function edit(Company $company)
    {
        
        return view('companies.edit', compact('company'));
    }

  
    public function update(Request $request, Company $company)
    {

        $request->validate([
            'name' => 'required',
            'website' => 'nullable|url',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'description' => 'nullable',
        ]);

        $logoPath = $company->logo;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        $company->update([
            'name' => $request->name,
            'website' => $request->website,
            'logo' => $logoPath,
            'description' => $request->description,
        ]);

        return redirect()->route('companies.show', $company->id)
                         ->with('success', 'The company has been modified successfully.');
    }

 
    public function destroy(Company $company)
    {
        
        $company->delete();
        return redirect('/')->with('success', 'The company has been deleted.');
    }
}