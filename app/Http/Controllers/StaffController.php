<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\EditHistory;
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
            'memo' => 'nullable'
        ]);

        $staff = Staff::findOrFail($id);
        $oldValues = $staff->getOriginal();

        $staff->update($validated);

        foreach ($validated as $key => $value) {
            if ($oldValues[$key] != $value) {
                EditHistory::create([
                    'staff_id' => $staff->id,
                    'type' => $key == 'memo' ? 'memo' : 'field',
                    'field' => $key,
                    'old_value' => $oldValues[$key],
                    'new_value' => $value
                ]);
            }
        }

        return redirect()->route('staff.show', $staff->id);
    }

    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();

        return redirect()->route('staff.index');
    }
}
