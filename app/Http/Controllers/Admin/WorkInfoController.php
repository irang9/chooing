<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class WorkInfoController extends Controller
{
    public function index()
    {
        return view('admin.work_info');
    }
}
