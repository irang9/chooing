<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacation;
use App\Models\VacationHistory;

class VacationController extends Controller
{
    public function index()
    {
        $vacations = Vacation::all();
        return view('vacation.index', compact('vacations'));
    }

    public function create()
    {
        return view('vacation.create');
    }

    public function store(Request $request)
    {
        $vacation = new Vacation();
        $vacation->fill($request->all());
        $vacation->status = '등록됨';
        $vacation->save();

        return redirect()->route('vacation.index');
    }

    public function show($id)
    {
        $vacation = Vacation::findOrFail($id);
        return view('vacation.show', compact('vacation'));
    }

    public function update(Request $request, $id)
    {
        $vacation = Vacation::findOrFail($id);
        $originalData = $vacation->getOriginal();

        $vacation->update($request->all());

        $changes = $vacation->getChanges();

        foreach ($changes as $field => $newValue) {
            if ($field !== 'updated_at') {
                VacationHistory::create([
                    'vacation_id' => $vacation->id,
                    'field' => $field,
                    'old_value' => $originalData[$field],
                    'new_value' => $newValue,
                ]);
            }
        }

        return redirect()->route('vacation.show', $vacation->id)->with('success', '휴가 정보가 수정되었습니다.');
    }

    public function destroy($id)
    {
        $vacation = Vacation::findOrFail($id);
        $vacation->delete();

        return redirect()->route('vacation.index');
    }
}
