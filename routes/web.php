<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; // Request 클래스 추가
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\VacationController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('main'); // resources/views/main.blade.php
});

// // 사원 목록 페이지
// Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
// // 새 직원 입력 페이지
// Route::get('/employees/new', [EmployeeController::class, 'create'])->name('employees.create');
// // 사원 정보 페이지
// Route::get('/employees/{id}', [EmployeeController::class, 'show'])->name('employees.show');
// // 새 직원 추가
// Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
// // 기존 직원 정보 업데이트
// Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
// // 기존 직원 정보 삭제
// Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

// 게시글 관련 라우트
Route::resource('posts', PostController::class);

// 사원 관련 라우트
Route::resource('staff', StaffController::class);

Route::get('/vacation', function () {
    return view('vacation.index'); // resources/views/vacation/index.blade.php
});

Route::resource('vacation', VacationController::class);

// 관리자 대시보드 페이지
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard'); // resources/views/admin/dashboard.blade.php
});

// 휴가 시스템 설정 페이지
Route::get('/vacation/setting', function () {
    return view('vacation.setting'); // resources/views/vacation/setting.blade.php
})->name('vacation.setting');

Route::post('/vacation/setting', function (Request $request) {
    // 설정 저장 로직 추가
    return redirect()->route('vacation.setting')->with('success', '설정이 저장되었습니다.');
})->name('vacation.setting.save);
