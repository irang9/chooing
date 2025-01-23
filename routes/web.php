<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; // Request 클래스 추가
use App\Http\Controllers\PostController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\VacationController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// 게시글 관련 라우트
Route::resource('posts', PostController::class);

// 사원 관련 라우트
Route::resource('staff', StaffController::class);

// 휴가 관련 라우트
Route::resource('vacation', VacationController::class);

// 관리자 대시보드 페이지
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard'); // resources/views/admin/dashboard.blade.php
});

// 휴가 시스템 설정 페이지
Route::get('/vacation/setting', function () {
    return view('vacation.setting'); // resources/views/vacation/setting.blade.php
})->name('vacation.setting');



