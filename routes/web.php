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

Route::middleware(['auth', 'manager'])->group(function () {         //Маршруты связанные с редактированием расписания
    Route::get('/timetable/edit', [\App\Http\Controllers\TimetableController::class, 'edit'])->name('editTimetable');
    Route::get('/timetable/edit/{class_id}', [\App\Http\Controllers\TimetableController::class, 'editForm'])->name('editFormTimetable');
    Route::Post('/timetable/edit/{class_id}/file', [\App\Http\Controllers\TimetableController::class, 'storeFile'])->name('storeFileTimetable');
    Route::Post('/timetable/edit/{class_id}/form', [\App\Http\Controllers\TimetableController::class, 'storeForm'])->name('storeFormTimetable');
});

Route::post('/classes', [\App\Http\Controllers\ClassesController::class, 'store'])->name('storeClasses');
Route::get('/classes/edit', [\App\Http\Controllers\ClassesController::class, 'edit'])->name('editClasses');
Route::patch('/classes/edit', [\App\Http\Controllers\ClassesController::class, 'update'])->name('updateClasses');
Route::delete('/classes/{class_id}', [\App\Http\Controllers\ClassesController::class, 'destroy'])->name('destroyClasses');

Route::get('/classes/login', [\App\Http\Controllers\ClassesController::class, 'loginPage'])->name('classesLoginPage');
Route::post('/classes/login', [\App\Http\Controllers\ClassesController::class, 'login'])->name('classesLogin');
Route::get('/classes/logout', [\App\Http\Controllers\ClassesController::class, 'logout'])->name('classLogout');


require __DIR__.'/auth.php';
