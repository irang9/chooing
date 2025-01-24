<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EditHistory;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users')); // 뷰 폴더도 users로 수정
    }

    public function create()
    {
        return view('users.create'); // 뷰 폴더도 users로 수정
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

        User::create($validated); // Staff → User로 수정
        return redirect()->route('users.index')->with('success', '사용자가 등록되었습니다.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id); // Staff → User로 수정
        return view('users.show', compact('user')); // 뷰 폴더와 변수명 수정
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); // Staff → User로 수정
        return view('users.edit', compact('user')); // 뷰 폴더와 변수명 수정
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

        $user = User::findOrFail($id); // Staff → User로 수정
        $oldValues = $user->getOriginal(); // 변수명 변경

        $user->update($validated);

        foreach ($validated as $key => $value) {
            if ($oldValues[$key] != $value) {
                EditHistory::create([
                    'user_id' => $user->id, // staff_id → user_id
                    'type' => $key == 'memo' ? 'memo' : 'field',
                    'field' => $key,
                    'old_value' => $oldValues[$key],
                    'new_value' => $value
                ]);
            }
        }

        return redirect()->route('users.show', $user->id)->with('success', '사용자가 수정되었습니다.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id); // Staff → User로 수정
        $user->delete();

        return redirect()->route('users.index');
    }
}