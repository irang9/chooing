<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserHistoryController;
use App\Http\Controllers\VacationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\CompanyInfoController;
use App\Http\Controllers\Admin\WorkInfoController;
use App\Http\Controllers\Admin\VacationInfoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\OfficeController;

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
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('company_info', [CompanyInfoController::class, 'index'])->name('company_info.index');
    Route::post('company_info', [CompanyInfoController::class, 'store'])->name('company_info.store');
    Route::get('work_info', [WorkInfoController::class, 'index'])->name('work_info.index');
    Route::get('vacation_info', [VacationInfoController::class, 'index'])->name('vacation_info.index');
});

// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login']);
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// // 로그인 페이지
// Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');

// 로그인 페이지 라우트가 AdminLoginController로 변경된 이유는 보안 및 유지보수 용이성을 위해서입니다.

Route::prefix('office')->name('office.')->group(function () {
    Route::get('/', [OfficeController::class, 'index'])->name('index');
    Route::get('link', [OfficeController::class, 'link'])->name('link.index');
    Route::get('account', [OfficeController::class, 'account'])->name('account.index');
    Route::get('partner', [OfficeController::class, 'partner'])->name('partner.index');
});



