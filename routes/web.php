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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//user
Route::group(['middleware' =>['auth', 'role:user']], function() {
    Route::get('/teacher/home', [App\Http\Controllers\TeacherController::class, 'home'])->name('home.teacher');
    Route::get('/teacher/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('teacher.profile');
});

//admin
Route::group(['middleware' =>['auth', 'role:admin']], function() {
    Route::get('/admin/home', [App\Http\Controllers\AdminController::class, 'index'])->name('home.admin');
    Route::get('/admin/teachers', [App\Http\Controllers\AdminController::class, 'teachers'])->name('admin.teacher');
    Route::get('/admin/leaves', [App\Http\Controllers\AdminController::class, 'leave'])->name('admin.leave');
    Route::get('/admin/leaves/approve', [App\Http\Controllers\AdminController::class, 'approved_leave'])->name('admin.approved.leave');
    Route::get('/admin/transfers', [App\Http\Controllers\AdminController::class, 'transfers'])->name('admin.transfer');
    Route::get('/admin/transfers/approve', [App\Http\Controllers\AdminController::class, 'approve_transfers'])->name('approve.transfers');
    Route::get('/admin/leave-report', [App\Http\Controllers\AdminController::class, 'leaveReport'])->name('admin.leave.report');
    Route::get('/admin/transfer-report', [App\Http\Controllers\AdminController::class, 'TransferReport'])->name('admin.leave.transfer');
    Route::post('/admin/transfer-report', [App\Http\Controllers\AdminController::class, 'approveTransfere'])->name('admin.approve.transfer');
    Route::post('admin/trans', [App\Http\Controllers\TransferController::class, 'approve'])->name('approve.trans');

});



Route::resource('teacher', App\Http\Controllers\TeacherController::class);

Route::resource('leave', App\Http\Controllers\LeaveController::class)->middleware('auth');

Route::resource('transfer', App\Http\Controllers\TransferController::class);

Route::resource('school', App\Http\Controllers\SchoolController::class);
