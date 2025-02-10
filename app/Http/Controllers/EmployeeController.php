<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $employees = Employee::query()
            ->with('company:id,name')
            ->select('id', 'first_name', 'last_name', 'email', 'phone', 'company_id')
            ->paginate(15);

        if ($request->wantsJson()) {
            return response()->json([
                'data' => $employees
            ]);
        }

        return Inertia::render('Employees/Index', [
            'employees' => $employees
        ]);
    }

    /**
     * API method for displaying a listing of the resource.
     */
    public function apiIndex()
    {
        return response()->json(
            Employee::query()
                ->with('company:id,name')
                ->select('id', 'first_name', 'last_name', 'email', 'phone', 'company_id')
                ->paginate(15)
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Employees/Create', [
            'companies' => Company::select('id', 'name')->get()
        ]);
    }

    /**
     * API method for displaying the specified resource.
     */
    public function apiShow(Employee $employee)
    {
        return response()->json([
            'data' => $employee->load('company:id,name')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $validated = $request->validated();
        
        Employee::create($validated);

        return redirect()->route('employees.index')
            ->with('message', 'Çalışan başarıyla oluşturuldu.');
    }

    /**
     * API method for storing a newly created resource in storage.
     */
    public function apiStore(StoreEmployeeRequest $request)
    {
        $employee = Employee::create($request->validated());

        return response()->json([
            'message' => 'Çalışan başarıyla oluşturuldu.',
            'data' => $employee->load('company:id,name')
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return Inertia::render('Employees/Edit', [
            'employee' => $employee->load('company:id,name'),
            'companies' => Company::select('id', 'name')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $validated = $request->validated();
        
        $employee->update($validated);

        return redirect()->route('employees.index')
            ->with('message', 'Çalışan başarıyla güncellendi.');
    }

    /**
     * API method for updating the specified resource in storage.
     */
    public function apiUpdate(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());

        return response()->json([
            'message' => 'Çalışan başarıyla güncellendi.',
            'data' => $employee->load('company:id,name')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('message', 'Çalışan başarıyla silindi.');
    }

    /**
     * API method for removing the specified resource from storage.
     */
    public function apiDestroy(Employee $employee)
    {
        $employee->delete();

        return response()->json([
            'message' => 'Çalışan başarıyla silindi.'
        ]);
    }
}
