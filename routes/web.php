<?php

use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;

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

Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('index');

//Маршруты связанные с изменением учителей
Route::middleware(['auth', 'Admin'])->prefix('teacher')->group(function () {
    Route::get('/', [\App\Http\Controllers\TeacherController::class, 'index'])->name('teacher.index');
    Route::post('/', [\App\Http\Controllers\TeacherController::class, 'store'])->name('teacher.store');
    Route::patch('/{id}', [\App\Http\Controllers\TeacherController::class, 'update'])->name('teacher.update');
    Route::delete('/{id}', [\App\Http\Controllers\TeacherController::class, 'destroy'])->name('teacher.destroy');
});

//Маршуты связанные с получением учителей
Route::prefix('teacher')->group(function () {
    Route::get('/get', [\App\Http\Controllers\TeacherController::class, 'getTeachers'])->name('teacher.get');
    Route::get('/get/{id}', [\App\Http\Controllers\TeacherController::class, 'getTeacher'])->name('teacher.getById');
});

//Маршруты связанные с изменением уроков
Route::middleware(['auth', 'Admin'])->prefix('lesson')->group(function () {
    Route::get('/', [\App\Http\Controllers\LessonController::class, 'index'])->name('lesson.index');
    Route::patch('/{id}', [\App\Http\Controllers\LessonController::class, 'update'])->name('lesson.update');
    Route::post('/', [\App\Http\Controllers\LessonController::class, 'store'])->name('lesson.store');
    Route::delete('/{id}', [\App\Http\Controllers\LessonController::class, 'destroy'])->name('lesson.destroy');
});

//Маршруты связнные с полученимем предметов
Route::prefix('lesson')->group(function () {
    Route::get('/get', [\App\Http\Controllers\LessonController::class, 'getLessons'])->name('lesson.getAll');
    Route::get('/get/{id}', [\App\Http\Controllers\LessonController::class, 'getLesson'])->name('lesson.getOne');
});

//Маршруты связанные с изменением кабинетов
Route::middleware(['auth', 'Admin'])->prefix('room')->group(function () {
    Route::get('/', [\App\Http\Controllers\RoomController::class, 'index'])->name('room.index');
    Route::patch('/{id}', [\App\Http\Controllers\RoomController::class, 'update'])->name('room.update');
    Route::post('/', [\App\Http\Controllers\RoomController::class, 'store'])->name('room.store');
    Route::delete('/{id}', [\App\Http\Controllers\RoomController::class, 'destroy'])->name('room.destroy');
});

//Иаршруты связанные с получением кабинетов
Route::prefix('room')->group(function () {
    Route::get('/get', [\App\Http\Controllers\RoomController::class, 'getAll'])->name('room.getAll');
    Route::get('/get/{id}', [\App\Http\Controllers\RoomController::class, 'getById'])->name('room.getById');
});

//Маршруты связанные с изменением нагрузки
Route::middleware(['auth'])->prefix('load')->group(function () {
    Route::get('/', [\App\Http\Controllers\LoadController::class, 'index'])->name('load.index');
    Route::patch('/{id}', [\App\Http\Controllers\LoadController::class, 'update'])->name('load.update');
    Route::post('/', [\App\Http\Controllers\LoadController::class, 'store'])->name('load.store');
    Route::delete('/{id}', [\App\Http\Controllers\LoadController::class, 'destroy'])->name('load.destroy');
});

//Марщруты связанные с получением нагрузки
Route::prefix('load')->group(function () {
    Route::get('/get', [\App\Http\Controllers\LoadController::class, 'getAllLoad'])->name('load.getAll');
    Route::get('/get/class/{class_id}', [\App\Http\Controllers\LoadController::class, 'getForClass'])->name('load.getForClass');
    Route::get('/get/teacher/{teahcer_id}', [\App\Http\Controllers\LoadController::class, 'getForTeacher'])->name('load.getForTeacher');
    Route::get('/get/{id}', [\App\Http\Controllers\LoadController::class, 'getLoad'])->name('load.getOne');
});

//Маршруты связанные с пользователями
Route::middleware(['auth'])->prefix('user')->group(function() {
    Route::get('/find/{login}', [\App\Http\Controllers\UserController::class, 'findUsers'])->middleware('Admin')->name('user.find');
    Route::get('/get/{id}', [\App\Http\Controllers\UserController::class, 'getUserForCreateTeacher'])->middleware('Admin')->name('user.get');
    Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'indexUsers'])->middleware('Admin')->name('adminUsers');
    Route::get('/{id}/{type}', [\App\Http\Controllers\Admin\AdminController::class, 'changeUserType'])->middleware('Admin')->name('changeUserType');
    Route::post('/class', [\App\Http\Controllers\Admin\AdminController::class, 'changeTeacherClass'])->middleware('Admin')->name('changeTeacherClass');
    Route::get('/register', [\App\Http\Controllers\Admin\AdminController::class, 'registerUserPage'])->middleware('Admin')->name('adminRegisterUserPage');
    Route::post('/register', [\App\Http\Controllers\Admin\AdminController::class, 'registerUser'])->middleware('Admin')->name('adminRegisterUser');
    Route::get('/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('userEdit');
    Route::post('/store', [\App\Http\Controllers\UserController::class, 'store'])->name('userStore');
});

//Маршруты связанные с редактированием расписания
Route::middleware(['auth', 'Admin'])->prefix('timetable')->group(function () {
    Route::get('/edit', [\App\Http\Controllers\TimetableController::class, 'edit'])->name('editTimetable');
    Route::get('/edit/{class_id}', [\App\Http\Controllers\TimetableController::class, 'editForm'])->name('editFormTimetable');
    Route::Post('/edit/{class_id}/file', [\App\Http\Controllers\TimetableController::class, 'storeFile'])->name('storeFileTimetable');
    Route::Post('/edit/{class_id}/form', [\App\Http\Controllers\TimetableController::class, 'storeForm'])->name('storeFormTimetable');
    Route::Post('/edit/archive', [\App\Http\Controllers\TimetableController::class, 'storeArchive'])->name('storeArchiveTimetable');
    Route::Post('/edit/xml', [\App\Http\Controllers\TimetableController::class, 'storeXml'])->name('timetable.storeXml');

});

// Маршруты связанные с получением расписания
Route::prefix('timetable')->group(function () {
    Route::get('/{class}', [\App\Http\Controllers\TimetableController::class, 'getByClass'])->name('timetable.getByClass');
    Route::get('/teacher/{teacher_id}', [\App\Http\Controllers\TimetableController::class, 'getByTeacher'])->name('timetable.getByTeacher');
    Route::get('/id/{id}', [\App\Http\Controllers\TimetableController::class, 'getById'])->name('timetable.getById');
    Route::get('/', [\App\Http\Controllers\TimetableController::class, 'get'])->name('timetable.get');
});

//Маршруты связанные с созданием и редактированием классов
Route::middleware(['auth', 'Admin'])->prefix('classes')->group(function () {
    Route::get('/', [\App\Http\Controllers\ClassesController::class, 'index'])->name('classes.index');
    Route::post('/', [\App\Http\Controllers\ClassesController::class, 'store'])->name('classes.store');
    Route::patch('/edit/{id}', [\App\Http\Controllers\ClassesController::class, 'update'])->name('classes.update');
    Route::delete('/{class_id}', [\App\Http\Controllers\ClassesController::class, 'destroy'])->name('classes.delete');
});

//Марщруты связанные с получением классов
Route::prefix('classes')->group(function () {
    Route::get('/get', [\App\Http\Controllers\ClassesController::class, 'get'])->name('classes.get');
    Route::get('/get/{id}', [\App\Http\Controllers\ClassesController::class, 'getById'])->name('classes.getById');
});

//Маршруты связанные с аутентификацией в классы
Route::middleware('guest')->prefix('classes')->group(function () {
    Route::get('/login', [\App\Http\Controllers\ClassesLoginController::class, 'loginPage'])->name('classesLoginPage');
    Route::post('/login', [\App\Http\Controllers\ClassesLoginController::class, 'login'])->name('classesLogin');
    Route::get('/logout', [\App\Http\Controllers\ClassesLoginController::class, 'logout'])->name('classLogout');
});

//Маршруты связанные с расписанием звонков
Route::middleware(['auth', 'Admin'])->prefix('ring')->group(function () {
    Route::post('/edit', [\App\Http\Controllers\RingScheduleController::class, 'update'])->name('ringUpdate');
    Route::get('/edit', [\App\Http\Controllers\RingScheduleController::class, 'edit'])->name('ringEdit');
});

//Маршруты связанные с объявлениями
Route::prefix('announcements')->group(function () {
    Route::get('/', [\App\Http\Controllers\AnnouncementsController::class, 'index'])->middleware('auth')->name('announcementsIndex');
    Route::get('/create', [\App\Http\Controllers\AnnouncementsController::class, 'create'])->middleware('auth')->name('announcementsCreate');
    Route::get('/{id}', [\App\Http\Controllers\AnnouncementsController::class, 'show'])->name('announcementShow');
    Route::post('/create', [\App\Http\Controllers\AnnouncementsController::class, 'store'])->middleware('auth')->name('announcementsStore');
    Route::post('/edit/{id}', [\App\Http\Controllers\AnnouncementsController::class, 'update'])->middleware('auth')->name('announcementsUpdate');
    Route::get('/edit/{id}', [\App\Http\Controllers\AnnouncementsController::class, 'edit'])->middleware('auth')->name('announcementsEdit');
    Route::delete('/delete/{id}', [\App\Http\Controllers\AnnouncementsController::class, 'delete'])->middleware('auth')->name('announcementsDelete');
});

Route::post('/615ddadc36de20ae8fe031c4af51524f/webhook', function () {
    $update = Telegram::commandsHandler(true);
});

require __DIR__.'/auth.php';
