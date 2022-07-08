<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('companies.index', [
            'companies' => Company::where('id', '>', -1)->simplePaginate(10)
        ]);
    }

    public function destroy(Company $company)
    {
        $company->employees()->delete();
        $company->delete();
        return redirect()->route('companies.index')->with('success','employee deleted successfully');
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
//
//        $path = request()->file('logo')->store('logos');
//
//        return 'done' . $path;
    $attributes = $request->validate([
        'name' => ['required', 'max:255', Rule::unique('companies', 'name')],
        'email' => ['email', 'required', 'max:255', Rule::unique('companies', 'email')],
        'logo' => ['required', 'image'],
        'website' => ['required', 'max:255', Rule::unique('companies', 'website')]
    ]);

    $attributes['logo'] = request()->file('logo')->store('logos');

    Company::create($attributes);

    return redirect()->route('companies.index')->with('success', 'company added successfully');
    }

    public function edit(Company $company)
    {
        return view('companies.edit',[
            'company' => $company
        ]);
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => ['required', 'max:255', Rule::unique('companies', 'name')->ignore($company)],
            'email' => ['email', 'required', 'max:255', Rule::unique('companies', 'email')->ignore($company)],
            'logo' => ['required', 'max:255'],
            'website' => ['required', 'max:255', Rule::unique('companies', 'website')->ignore($company)]
        ]);

        $company->update($request->all());

        return redirect()->route('companies.index')->with('success', 'company updated successfully');
    }
}
