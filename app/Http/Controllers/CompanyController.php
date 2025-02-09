<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index()
    {
        return Inertia::render('Companies/Index', [
            'companies' => Company::all()->map(function ($company) {
                return [
                    'id' => $company->id,
                    'name' => $company->name,
                    'email' => $company->email,
                    'website' => $company->website,
                    'logo_url' => $company->logo ? Storage::url($company->logo) : null,
                ];
            })
        ]);
    }

    public function create()
    {
        return Inertia::render('Companies/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email',
            'website' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=100,min_height=100',
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('public/logos');
            $validated['logo'] = str_replace('public/', '', $path);
        }

        Company::create($validated);

        return redirect()->route('companies.index')
            ->with('message', 'Şirket başarıyla oluşturuldu.');
    }

    public function edit(Company $company)
    {
        return Inertia::render('Companies/Edit', [
            'company' => [
                'id' => $company->id,
                'name' => $company->name,
                'email' => $company->email,
                'website' => $company->website,
                'logo_url' => $company->logo ? Storage::url($company->logo) : null,
            ]
        ]);
    }

    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email,' . $company->id,
            'website' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=100,min_height=100',
        ]);

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($company->logo) {
                Storage::delete('public/' . $company->logo);
            }
            
            $path = $request->file('logo')->store('public/logos');
            $validated['logo'] = str_replace('public/', '', $path);
        }

        $company->update($validated);

        return redirect()->route('companies.index')
            ->with('message', 'Şirket başarıyla güncellendi.');
    }

    public function destroy(Company $company)
    {
        if ($company->logo) {
            Storage::delete('public/' . $company->logo);
        }
        
        $company->delete();

        return redirect()->route('companies.index')
            ->with('message', 'Şirket başarıyla silindi.');
    }
}
