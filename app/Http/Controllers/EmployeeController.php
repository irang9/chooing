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
            'status' => 'required',  // 상태 필드 검증
        ]);

        Employee::create($validated);
        return redirect()->route('employees.index');
    }

    /**
     * Display the specified employee or show a form to create a new employee.
     */
    public function view($id = null)
    // public function view($id)
    {
        if ($id == 'new') {
            // return view('employees.view'); // 새 직원 입력 페이지로 이동
            return view('employees.view', ['employee' => null]);
        }

        $employee = Employee::findOrFail($id); // 기존 직원 정보를 찾아서
        return view('employees.view', compact('employee')); // 기존 직원 정보 페이지
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