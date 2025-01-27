<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserHistory;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateUserData($request);

        // 새 사용자 생성
        User::create(array_merge($validated, [
            'password' => null, // 비밀번호를 null로 설정
        ]));

        return redirect()->route('users.index')->with('success', '사원이 등록되었습니다.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validateUserData($request);

        $user = User::findOrFail($id);
        $oldValues = $user->getOriginal();

        // 사용자 정보 업데이트
        $user->update($validated);

        // 수정 기록 저장
        foreach ($validated as $key => $value) {
            if ($oldValues[$key] != $value) {
                UserHistory::create([
                    'user_id' => $user->id,
                    'type' => $key == 'memo' ? 'memo' : 'field',
                    'field' => $key,
                    'old_value' => $oldValues[$key],
                    'new_value' => $value
                ]);
            }
        }

        return redirect()->route('users.show', $user->id)->with('success', '사원이 수정되었습니다.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', '사원이 삭제되었습니다.');
    }

    /**
     * 공통 검증 메서드
     */
    private function validateUserData(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'company_phone' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'hire_date' => 'nullable|date',
            'status' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'memo' => 'nullable|string',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'work_days' => 'nullable|numeric|min:1|max:7',
        ]);
    }
}