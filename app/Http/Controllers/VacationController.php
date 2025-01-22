<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacation;

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
        $vacation->type = $request->type;
        $vacation->start_date = $request->start_date;
        $vacation->end_date = $request->end_date;
        $vacation->status = '등록됨';
        $vacation->save();

        return redirect()->route('vacation.index');
    }

    public function edit($id)
    {
        $vacation = Vacation::findOrFail($id);
        return view('vacation.edit', compact('vacation'));
    }

    public function update(Request $request, $id)
    {
        $vacation = Vacation::findOrFail($id);
        $vacation->type = $request->type;
        $vacation->start_date = $request->start_date;
        $vacation->end_date = $request->end_date;
        $vacation->status = $request->status;
        $vacation->save();

        return redirect()->route('vacation.index');
    }

    public function destroy($id)
    {
        $vacation = Vacation::findOrFail($id);
        $vacation->delete();

        return redirect()->route('vacation.index');
    }
}
