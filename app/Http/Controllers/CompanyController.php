<?php

namespace App\Http\Controllers;

use App\Mail\NewCompany;

use App\Models\Company;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class CompanyController extends Controller
{
    public function index()
    {
        // $companies = Company::paginate(10);
        $companies = Company::all();
        return view('companies', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|dimensions:min_width=100,min_height=100',
            'website' => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $validatedData['logo'] = $path;
        }

        $company = Company::create($validatedData);

        // dd($company);

        if (!empty($company)) {
            Mail::to($validatedData['email'])->send(new NewCompany($company));
        } else {
            Log::error('Failed');
        }        

        return redirect()->route('companies');
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|dimensions:min_width=100,min_height=100',
            'website' => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('logo')) {
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }
            $path = $request->file('logo')->store('logos', 'public');
            $validatedData['logo'] = $path;
        } else {
            $validatedData['logo'] = $company->logo;
        }

        $company->update($validatedData);
        return redirect()->route('companies');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies');
    }
}
