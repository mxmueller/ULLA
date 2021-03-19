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

Route::redirect('/', '/login');
Route::redirect('/home', '/dashboard');

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

Route::post('/request_submit_form_data', [App\Http\Controllers\Request\RequestFromSubmit::class, 'index']);
Route::post('/request_decision_submit', [App\Http\Controllers\Request\RequestDecision::class, 'descisionSubmit']);

// ----------------------------------------------------------------
// Application Views
Route::get('/permission-board', [App\Http\Controllers\Tasks\PermissionController::class, 'index'])->name('permission-board');
Route::get('/request/interface', [App\Http\Controllers\Request\RequestController::class, 'index'])->name('request-interface');
Route::get('/request/view', [App\Http\Controllers\Request\RequestView::class, 'index'])->name('request-view');
Route::get('/request/summary', [App\Http\Controllers\Request\RequestSummary::class, 'index']);
Route::get('/request/overview', [App\Http\Controllers\Request\RequestOverview::class, 'index'])->name('request-overview');
Route::get('/request/{id}/detail', [App\Http\Controllers\Request\RequestDetail::class, 'index'])->name('/request/{id}/detail');
Route::get('/request/{id}/decision', [App\Http\Controllers\Request\RequestDecision::class, 'index'])->name('/request/{id}/decision');
Route::get('/request/assigned', [App\Http\Controllers\Request\RequestAssigned::class, 'index'])->name('/request/assigned');
Route::get('/request/segmented/{sq}', [App\Http\Controllers\Request\RequestSummary::class, 'segmented']);
Route::get('/request/success', function () {
    return view('request.success');
});

Auth::routes();
