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
        $validated = $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'nullable|string'
        ]);

        Vacation::create($validated);
        return redirect()->route('vacation.index')->with('success', '휴가가 등록되었습니다.');
    }

    public function show($id)
    {
        $vacation = Vacation::with('staff')->findOrFail($id);
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
        $validated = $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'nullable|string'
        ]);

        $vacation = Vacation::findOrFail($id);
        $vacation->update($validated);

        return redirect()->route('vacation.index')->with('success', '휴가가 수정되었습니다.');
    }

    public function destroy($id)
    {
        $vacation = Vacation::findOrFail($id);
        $vacation->delete();

        return redirect()->route('vacation.index')->with('success', '휴가가 삭제되었습니다.');
    }
}
