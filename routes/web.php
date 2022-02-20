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

Route::get('/', [\App\Http\Controllers\indexController::class, 'index'])->name('index');

Route::middleware(['auth', 'manager'])->group(function () {         //Маршруты связанные с редактированием расписания
    Route::get('/timetable/edit', [\App\Http\Controllers\TimetableController::class, 'edit'])->name('editTimetable');
    Route::get('/timetable/edit/{class_id}', [\App\Http\Controllers\TimetableController::class, 'editForm'])->name('editFormTimetable');
    Route::Post('/timetable/edit/{class_id}/file', [\App\Http\Controllers\TimetableController::class, 'storeFile'])->name('storeFileTimetable');
    Route::Post('/timetable/edit/{class_id}/form', [\App\Http\Controllers\TimetableController::class, 'storeForm'])->name('storeFormTimetable');
});

Route::middleware(['auth', 'manager'])->group(function () {         //Маршруты связанные с созданием и редактированием классов
    Route::post('/classes', [\App\Http\Controllers\ClassesController::class, 'store'])->name('storeClasses');
    Route::get('/classes/edit', [\App\Http\Controllers\ClassesController::class, 'edit'])->name('editClasses');
    Route::patch('/classes/edit', [\App\Http\Controllers\ClassesController::class, 'update'])->name('updateClasses');
    Route::delete('/classes/{class_id}', [\App\Http\Controllers\ClassesController::class, 'destroy'])->name('destroyClasses');
});

Route::prefix('classes')->group(function () {               //Маршруты связанные с аутентификацией в классы
    Route::get('/login', [\App\Http\Controllers\ClassesController::class, 'loginPage'])->middleware('guest')->name('classesLoginPage');
    Route::post('/login', [\App\Http\Controllers\ClassesController::class, 'login'])->middleware('guest')->name('classesLogin');
    Route::get('/logout', [\App\Http\Controllers\ClassesController::class, 'logout'])->middleware('guest')->name('classLogout');
});

Route::middleware('admin')->group(function () {
    Route::get('/users', [\App\Http\Controllers\adminController::class, 'indexUsers'])->name('adminUsers');
    Route::get('/user/{id}/{type}', [\App\Http\Controllers\adminController::class, 'changeUserType'])->name('changeUserType');
    Route::post('/user/class', [\App\Http\Controllers\adminController::class, 'changeTeacherClass'])->name('changeTeacherClass');
});

Route::prefix('user')->middleware('auth')->group(function () {
    Route::get('/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('userEdit');
    Route::post('/store', [\App\Http\Controllers\UserController::class, 'store'])->name('userStore');
});

Route::prefix('announcements')->group(function () {
    Route::get('/', [\App\Http\Controllers\AnnouncementsController::class, 'index'])->middleware('auth')->name('announcementsIndex');
    Route::get('/create', [\App\Http\Controllers\AnnouncementsController::class, 'create'])->middleware('auth')->name('announcementsCreate');
    Route::get('/{id}', [\App\Http\Controllers\AnnouncementsController::class, 'show'])->name('announcementShow');
    Route::post('/create', [\App\Http\Controllers\AnnouncementsController::class, 'store'])->middleware('auth')->name('announcementsStore');
    Route::post('/edit/{id}', [\App\Http\Controllers\AnnouncementsController::class, 'update'])->middleware('auth')->name('announcementsUpdate');
    Route::get('/edit/{id}', [\App\Http\Controllers\AnnouncementsController::class, 'edit'])->middleware('auth')->name('announcementsEdit');
    Route::delete('/delete/{id}', [\App\Http\Controllers\AnnouncementsController::class, 'delete'])->middleware('auth')->name('announcementsDelete');

});

require __DIR__.'/auth.php';
