<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VacationController;
use App\Http\Controllers\HomeController;
// use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\LoginController;

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
Route::resource('users', UserController::class);

// 휴가 관련 라우트
Route::resource('vacation', VacationController::class);

// 관리자 대시보드 페이지
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard'); // resources/views/admin/dashboard.blade.php
});



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// // 로그인 페이지
// Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');

// 로그인 페이지 라우트가 AdminLoginController로 변경된 이유는 보안 및 유지보수 용이성을 위해서입니다.

Route::get('/office/index', function () {
    return view('office.index'); // resources/views/office/index.blade.php
});

