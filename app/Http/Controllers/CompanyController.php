<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\Company\StoreCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class CompanyController extends Controller
{
    public function index()
    {
        return Inertia::render('Companies/Index', [
            'companies' => Company::query()
                ->select('id', 'name', 'email', 'website', 'logo')
                ->paginate(15)
                ->through(function ($company) {
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

    public function store(StoreCompanyRequest $request)
    {
        $validated = $request->validated();

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

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $validated = $request->validated();

        if ($request->hasFile('logo')) {
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
