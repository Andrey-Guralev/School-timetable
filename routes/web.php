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

Route::get('/', [\App\Http\Controllers\Controller::class, 'index'])->name('index');

//Route::get('/timetable');
//Route::get('/timetable/{class_id}');
//Route::get('/timetable/p/{class_number}/{class_number_2?}');
//Route::get('/timetable/teacher/{teacher_id}');

Route::get('/timetable/edit', [\App\Http\Controllers\TimetableController::class, 'edit'])->name('editTimetable');
Route::get('/timetable/edit/{class_id}', [\App\Http\Controllers\TimetableController::class, 'editForm'])->name('editFormTimetable');
//Route::get('/timetable/edit/{class_id}', [\App\Http\Controllers\TimetableController::class, 'editForm'])->name('editFormTimetable');
Route::Post('/timetable/edit/{class_id}/file', [\App\Http\Controllers\TimetableController::class, 'storeFile'])->name('storeFileTimetable');


require __DIR__.'/auth.php';
