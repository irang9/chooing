<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacation;
use App\Models\VacationHistory;
use App\Models\EditHistory; // EditHistory 모델 임포트
use App\Models\Staff; // Staff 모델 임포트

class VacationController extends Controller
{
    public function index()
    {
        $vacations = Vacation::with('staff')->get();
        return view('vacation.index', compact('vacations'));
    }

    public function create()
    {
        $staffs = Staff::all();
        return view('vacation.create', compact('staffs'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            // ...other validation rules...
        ]);

        $vacation = new Vacation($validatedData);
        $vacation->status = 'pending'; // 기본값 설정
        $vacation->save();

        EditHistory::create([
            'type' => 'vacation',
            'field' => 'vacation',
            'old_value' => null,
            'new_value' => json_encode($vacation->toArray()),
            'edited_by' => 1, // 임시 사용자 ID
        ]);

        return redirect()->route('vacations.index')->with('success', '휴가가 등록되었습니다.');
    }

    public function show($id)
    {
        $vacation = Vacation::findOrFail($id);
        $staffs = Staff::all();
        return view('vacation.show', compact('vacation', 'staffs'));
    }

    public function edit($id)
    {
        $vacation = Vacation::findOrFail($id);
        $staffs = Staff::all();
        return view('vacation.edit', compact('vacation', 'staffs'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            // ...other validation rules...
        ]);

        $vacation = Vacation::findOrFail($id);
        $oldValue = $vacation->toArray();
        $vacation->update($validatedData);
        $newValue = $vacation->toArray();

        EditHistory::create([
            'type' => 'vacation',
            'field' => 'vacation',
            'old_value' => json_encode($oldValue),
            'new_value' => json_encode($newValue),
            'edited_by' => 1, // 임시 사용자 ID
        ]);

        return redirect()->route('vacations.index')->with('success', '휴가가 수정되었습니다.');
    }

    public function destroy($id)
    {
        $vacation = Vacation::findOrFail($id);
        $vacation->delete();

        return redirect()->route('vacations.index');
    }
}
