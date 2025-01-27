<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyInfo;

class OfficeController extends Controller
{
    public function index()
    {
        $companyInfo = CompanyInfo::all();
        return view('office.index', compact('companyInfo')); // resources/views/office/index.blade.php
    }

    public function link()
    {
        return view('office.link'); // resources/views/office/link.blade.php
    }

    public function account()
    {
        return view('office.account'); // resources/views/office/account.blade.php
    }

    public function partner()
    {
        return view('office.partner'); // resources/views/office/partner.blade.php
    }
}