<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::all();
        return view('staff.index', compact('staff'));
    }

    public function create()
    {
        return view('staff.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'company_phone' => 'nullable',
            'extension' => 'nullable',
            'email' => 'required|email',
            'hire_date' => 'required|date',
            'status' => 'required',
        ]);

        Staff::create($validated);
        return redirect()->route('staff.index');
    }

    public function show($id)
    {
        $staff = Staff::findOrFail($id);
        return view('staff.show', compact('staff'));
    }

    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        return view('staff.edit', compact('staff'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'company_phone' => 'nullable',
            'extension' => 'nullable',
            'email' => 'required|email',
            'hire_date' => 'required|date',
            'status' => 'required',
        ]);

        $staff = Staff::findOrFail($id);
        $staff->update($validated);

        return redirect()->route('staff.index');
    }

    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();

        return redirect()->route('staff.index');
    }
}
