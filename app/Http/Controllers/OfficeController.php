<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function index()
    {
        return view('office.index'); // resources/views/office/index.blade.php
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