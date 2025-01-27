<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class VacationInfoController extends Controller
{
    public function index()
    {
        return view('admin.vacation_info');
    }
}
