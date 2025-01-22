<?php

// ...existing code...

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StaffController;

// ...existing code...

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

// ...existing code...