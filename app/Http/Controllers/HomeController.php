<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacation;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $vacations = Vacation::all();
        $users = user::all();
        return view('home', compact('vacations', 'users'));
    }
}
