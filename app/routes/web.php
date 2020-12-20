<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('login');
// });

Route::redirect('/', '/login');
Route::redirect('/home', '/login');

Route::get('/app', function () {
    return view('layouts.app');
});


// ----------------------------------------------------------------
// User Roles
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/staff', [App\Http\Controllers\UserController\StaffController::class, 'index'])->name('staff');
// Route::get('/admin', [App\Http\Controllers\UserController\AdminController::class, 'index'])->name('admin');
// Route::get('/executive', [App\Http\Controllers\UserController\ExecutiveController::class, 'index'])->name('executive');
// Route::get('/accounting', [App\Http\Controllers\UserController\AccountingController::class, 'index'])->name('accounting');

// ----------------------------------------------------------------
// Post Requests
Route::post('/change_user_role', [App\Http\Controllers\UserActions\updateUserRole::class, 'index']);
Route::post('/delete_user', [App\Http\Controllers\UserActions\deleteUser::class, 'index']);


// ----------------------------------------------------------------
// Application Views
Route::get('/permission-board', [App\Http\Controllers\Tasks\PermissionController::class, 'index'])->name('permission-board');
Route::get('/request_interface', [App\Http\Controllers\Request\RequestInterface::class, 'index'])->name('request_interface');

Auth::routes();



