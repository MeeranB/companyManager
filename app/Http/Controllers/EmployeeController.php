<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $employees = Employee::where('id', '>', -1)->simplePaginate(10);

        return view('employees.index', [
            'employees' => $employees,
            'companies' => Company::all()
        ]);
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', [
            'employee' => $employee,
            'companies' => Company::all()
        ]);
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'email' => ['email', 'required', 'max:255', Rule::unique('employees', 'email')->ignore($employee)],
            'phone_number' => ['required', 'max:255', Rule::unique('employees', 'phone_number')->ignore($employee)],
            'company_id' => ['required', 'max:255']
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')->with('success', 'employee updated successfully');
    }

    public function create()
    {
        return view('employees.create', [
            'companies' => Company::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'email' => ['email', 'required', 'max:255',  Rule::unique('employees', 'email')],
            'phone_number' => ['required', 'max:255', Rule::unique('employees', 'phone_number')],
            'company_id' => ['required', 'max:255']
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')->with('success', 'employee added successfully');
    }

    public function destroy(Employee $employee): \Illuminate\Http\RedirectResponse
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success','employee deleted successfully');
    }
}
