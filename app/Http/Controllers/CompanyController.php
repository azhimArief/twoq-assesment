<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();
        return view('companies.companies', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.add-companies');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation rules
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:companies,name',
            'email' => 'required|email|max:255|unique:companies,email',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=100,min_height=100',
            'website' => 'required|url|max:255|unique:companies,website',
        ]);

        // Check if a file is uploaded
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');

            // Store the logo in 'storage/app/public/logos'
            $path = $logo->store('logos', 'public');

            // Add the file path to the validated data
            $validatedData['logo'] = $path;
        }

        // Save the company to the database
        Company::create($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('companies')->with('success', 'Company created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $companies = Company::find($id);
        return view('companies.edit-companies', compact('companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        // Validation rules
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:companies,name,' . $company->id, // Unique except current
            'email' => 'required|email|max:255|unique:companies,email,' . $company->id, // Unique except current
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=100,min_height=100',
            'website' => 'required|url|max:255|unique:companies,website,' . $company->id, // Unique except current
        ]);

        // Check if a new file is uploaded
        if ($request->hasFile('logo')) {
            // Delete old logo if it exists
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }

            // Store the new logo
            $logo = $request->file('logo');
            $path = $logo->store('logos', 'public'); // Store in 'storage/app/public/logos'
            $validatedData['logo'] = $path; // Add path to validated data
        }

        // Update the company record with validated data
        $company->update($validatedData);

        // Redirect to main page with success message
        return redirect()->route('companies')->with('success', 'Company updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the company by ID
        $company = Company::find($id);

        // Check if the logo exists and delete it from storage
        if ($company->logo) {
            // Delete the logo from storage
            Storage::disk('public')->delete($company->logo);
        }

        // Delete the company from the database
        $company->delete();

        // Redirect to the main page with a success message
        return redirect()->route('companies')->with('success', 'Company deleted successfully!');
    }
}
