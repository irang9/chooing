<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacation;
use App\Models\Staff;

class HomeController extends Controller
{
    public function index()
    {
        $vacations = Vacation::all();
        $staff = Staff::all();
        return view('home', compact('vacations', 'staff'));
    }
}
