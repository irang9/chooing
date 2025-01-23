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
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'company_phone' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'hire_date' => 'nullable|date',
            'status' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255', // 직함 필드 추가
            'birthday' => 'nullable|date', // 생일 필드 추가
            'memo' => 'nullable|string',
            'start_time' => 'nullable|date_format:H:i', // 출근 시간 필드 추가
            'end_time' => 'nullable|date_format:H:i', // 퇴근 시간 필드 추가
            'work_days' => 'nullable|numeric|min:1|max:7' // 주 근무시간 필드 추가
        ]);

        Staff::create($validated);
        return redirect()->route('staff.index')->with('success', '사원이 등록되었습니다.');
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
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'company_phone' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'hire_date' => 'nullable|date',
            'status' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255', // 직함 필드 추가
            'birthday' => 'nullable|date', // 생일 필드 추가
            'memo' => 'nullable|string',
            'start_time' => 'nullable|date_format:H:i', // 출근 시간 필드 추가
            'end_time' => 'nullable|date_format:H:i', // 퇴근 시간 필드 추가
            'work_days' => 'nullable|numeric|min:1|max:7' // 주 근무시간 필드 추가
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

        return redirect()->route('staff.show', $staff->id)->with('success', '사원이 수정되었습니다.');
    }

    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();

        return redirect()->route('staff.index');
    }
}
