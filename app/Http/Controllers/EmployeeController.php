<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('company')->paginate(10);
        $companies = Company::all();
        return view('dashboard', compact('employees', 'companies'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
        ]);

        Employee::create($validatedData);

        return redirect()->route('dashboard');
    }

    public function edit(Employee $employee)
    {
        $companies = Company::all();
        return view('employees.edit', compact('employee', 'companies'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
        ]);

        $employee->update($validatedData);
        return redirect()->route('dashboard');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('dashboard');
    }
}
