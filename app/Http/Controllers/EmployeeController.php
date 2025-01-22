<?php // app/Http/Controllers/EmployeeController.php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of employees.
     */
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    /**
     * Store a newly created employee in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'hire_date' => 'required|date',
            'status' => 'required',
        ]);

        Employee::create($validated);
        return redirect()->route('employees.index');
    }

    /**
     * Display the specified employee or show a form to create a new employee.
     */
    public function view($id = null)
    {
        if ($id == 'new') {
            return view('employees.form', ['employee' => null]);
        }

        $employee = Employee::findOrFail($id);
        return view('employees.form', compact('employee'));
    }

    /**
     * Update the specified employee in the database.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'hire_date' => 'required|date',
            'status' => 'required',  // 상태 필드 검증
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update($validated);

        return redirect()->route('employees.index');
    }
}