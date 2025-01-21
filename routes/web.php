<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\EmployeeController;



// 사원 목록 페이지
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');

// 새 직원 입력 페이지 (id가 'new'일 때)
Route::get('/employees/new', [EmployeeController::class, 'view'])->name('employees.create'); 

// 기존 직원 보기 및 수정 페이지
Route::get('/employees/{id}', [EmployeeController::class, 'view'])->name('employees.view'); 

// 새 직원 추가
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');  

// 기존 직원 정보 업데이트
Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');