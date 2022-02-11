<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Setup\ExamTypeController;
use App\Http\Controllers\Backend\Setup\FeeAmountController;
use App\Http\Controllers\Backend\Setup\StudentFeeController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Setup\SchoolSubjectController;
use App\Http\Controllers\Backend\Students\StudentRegController;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Manage User All Router
Route::prefix('users')->group(function () {
    Route::get('/view', [UserController::class, 'view'])->name('user.view');
    Route::get('/add', [UserController::class, 'add'])->name('user.add');
    Route::post('/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
});

// Profile Manage All Router
Route::prefix('profile')->group(function () {
    Route::get('/view', [ProfileController::class, 'view'])->name('profile.view');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/store', [ProfileController::class, 'store'])->name('profile.store');
    Route::get('/password/view', [ProfileController::class, 'viewPassword'])->name('password.view');
    Route::post('/password/update', [ProfileController::class, 'updatePassword'])->name('password.update');
});


// Setup Manage All Router
Route::prefix('setups')->group(function () {
    // Student Class Route
    Route::get('student/class/view', [StudentClassController::class, 'view'])->name('student.class.view');
    Route::get('student/class/add', [StudentClassController::class, 'add'])->name('student.class.add');
    Route::post('student/class/store', [StudentClassController::class, 'store'])->name('student.class.store');
    Route::get('student/class/edit/{id}', [StudentClassController::class, 'edit'])->name('student.class.edit');
    Route::post('student/class/update/{id}', [StudentClassController::class, 'update'])->name('student.class.update');
    Route::get('student/class/delete/{id}', [StudentClassController::class, 'delete'])->name('student.class.delete');

    // Student Year Route
    Route::get('student/year/view', [StudentYearController::class, 'view'])->name('student.year.view');
    Route::get('student/year/add', [StudentYearController::class, 'add'])->name('student.year.add');
    Route::post('student/year/store', [StudentYearController::class, 'store'])->name('student.year.store');
    Route::get('student/year/edit/{id}', [StudentYearController::class, 'edit'])->name('student.year.edit');
    Route::post('student/year/update/{id}', [StudentYearController::class, 'update'])->name('student.year.update');
    Route::get('student/year/delete/{id}', [StudentYearController::class, 'delete'])->name('student.year.delete');

     // Student Group Route
     Route::get('student/group/view', [StudentGroupController::class, 'view'])->name('student.group.view');
     Route::get('student/group/add', [StudentGroupController::class, 'add'])->name('student.group.add');
     Route::post('student/group/store', [StudentGroupController::class, 'store'])->name('student.group.store');
     Route::get('student/group/edit/{id}', [StudentGroupController::class, 'edit'])->name('student.group.edit');
     Route::post('student/group/update/{id}', [StudentGroupController::class, 'update'])->name('student.group.update');
     Route::get('student/group/delete/{id}', [StudentGroupController::class, 'delete'])->name('student.group.delete');

      // Student Shift Route
      Route::get('student/shift', [StudentShiftController::class, 'view'])->name('student.shift.view');
      Route::get('student/shift/add', [StudentShiftController::class, 'add'])->name('student.shift.add');
      Route::post('student/shift/store', [StudentShiftController::class, 'store'])->name('student.shift.store');
      Route::get('student/shift/edit/{id}', [StudentShiftController::class, 'edit'])->name('student.shift.edit');
      Route::post('student/shift/update/{id}', [StudentShiftController::class, 'update'])->name('student.shift.update');
      Route::get('student/shift/delete/{id}', [StudentShiftController::class, 'delete'])->name('student.shift.delete');

      // Student Fee Route
      Route::get('student/fee', [StudentFeeController::class, 'view'])->name('student.fee.view');
      Route::get('student/fee/add', [StudentFeeController::class, 'add'])->name('student.fee.add');
      Route::post('student/fee/store', [StudentFeeController::class, 'store'])->name('student.fee.store');
      Route::get('student/fee/edit/{id}', [StudentFeeController::class, 'edit'])->name('student.fee.edit');
      Route::post('student/fee/update/{id}', [StudentFeeController::class, 'update'])->name('student.fee.update');
      Route::get('student/fee/delete/{id}', [StudentFeeController::class, 'delete'])->name('student.fee.delete');

      // Student Fee Route
      Route::get('fee/amount', [FeeAmountController::class, 'view'])->name('fee.amount.view');
      Route::get('fee/amount/add', [FeeAmountController::class, 'add'])->name('fee.amount.add');
      Route::post('fee/amount/store', [FeeAmountController::class, 'store'])->name('fee.amount.store');
      Route::get('fee/amount/edit/{fee_category_id}', [FeeAmountController::class, 'edit'])->name('fee.amount.edit');
      Route::post('fee/amount/update/{fee_category_id}', [FeeAmountController::class, 'update'])->name('fee.amount.update');
      Route::get('fee/amount/detail/{fee_category_id}', [FeeAmountController::class, 'detail'])->name('fee.amount.detail');

       // Exam Type Route
     Route::get('exam/type/view', [ExamTypeController::class, 'view'])->name('exam.type.view');
     Route::get('exam/type/add', [ExamTypeController::class, 'add'])->name('exam.type.add');
     Route::post('exam/type/store', [ExamTypeController::class, 'store'])->name('exam.type.store');
     Route::get('exam/type/edit/{id}', [ExamTypeController::class, 'edit'])->name('exam.type.edit');
     Route::post('exam/type/update/{id}', [ExamTypeController::class, 'update'])->name('exam.type.update');
     Route::get('exam/type/delete/{id}', [ExamTypeController::class, 'delete'])->name('exam.type.delete');

       // School Subject Route
     Route::get('school/subject/view', [SchoolSubjectController::class, 'view'])->name('school.subject.view');
     Route::get('school/subject/add', [SchoolSubjectController::class, 'add'])->name('school.subject.add');
     Route::post('school/subject/store', [SchoolSubjectController::class, 'store'])->name('school.subject.store');
     Route::get('school/subject/edit/{id}', [SchoolSubjectController::class, 'edit'])->name('school.subject.edit');
     Route::post('school/subject/update/{id}', [SchoolSubjectController::class, 'update'])->name('school.subject.update');
     Route::get('school/subject/delete/{id}', [SchoolSubjectController::class, 'delete'])->name('school.subject.delete');

});

// Students Manage All Router
Route::prefix('students')->group(function () {
    // Student Class Route
    Route::get('student/registration/view', [StudentRegController::class, 'view'])->name('student.registration.view');
    Route::get('student/registration/add', [StudentRegController::class, 'add'])->name('student.registration.add');
    Route::post('student/registration/store', [StudentRegController::class, 'store'])->name('student.registration.store');
    Route::get('student/registration/edit/{student_id}', [StudentRegController::class, 'edit'])->name('student.registration.edit');
    Route::post('student/registration/update/{student_id}', [StudentRegController::class, 'update'])->name('student.registration.update');
    Route::get('student/registration/delete/{id}', [StudentRegController::class, 'delete'])->name('student.registration.delete');

    Route::get('student/registration/search', [StudentRegController::class, 'search'])->name('student.registration.search');
    Route::get('student/registration/details/{student_id}', [StudentRegController::class, 'details'])->name('student.registration.detailsdetails');


});
