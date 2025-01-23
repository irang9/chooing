<?php
namespace App\Http\Controllers;

use App\Models\EditHistory;
use Illuminate\Http\Request;

class EditHistoryController extends Controller
{
    public function destroy($id)
    {
        $editHistory = EditHistory::findOrFail($id);
        $editHistory->delete();

        return redirect()->back();
    }
}
