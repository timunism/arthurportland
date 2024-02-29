<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PulseController;
use App\Http\Controllers\ApplicationChatbotController;
use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\ApplyController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DtefController;
use App\Http\Controllers\DtefAdmissionController;
use App\Http\Controllers\DtefResultController;
use App\Http\Controllers\DtefRegistrationController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\ImportApplicantsController;
use App\Http\Controllers\RolesController;
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

// VIEWS
Route::view('/', 'welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('dtef/admissions', [DtefController::class, 'admissions'])
    ->middleware(['auth'])
    ->name('dtef.admissions');

Route::get('dtef/registrations', [DtefController::class, 'registrations'])
    ->middleware(['auth'])
    ->name('dtef.registrations');

Route::get('dtef/results', [DtefController::class, 'results'])
    ->middleware(['auth'])
    ->name('dtef.results');

Route::get('dtef/registrations/edit/{id}', [DtefController::class, 'editregistration'])
    ->middleware(['auth'])
    ->name('dtef.editregistration');

Route::get('dtef/admissions/edit/{id}', [DtefController::class, 'editadmission'])
    ->middleware(['auth'])
    ->name('dtef.editadmission');

Route::get('dtef/results/edit/{id}', [DtefController::class, 'editresult'])
    ->middleware(['auth'])
    ->name('dtef.editresult');
    
Route::resource('dtef', DtefController::class)
    ->middleware(['auth']);

Route::get('dtefsubmission/bulk', [DtefAdmissionController::class, 'bulk'])
    ->middleware(['auth'])
    ->name('dtefsubmission.bulk');

Route::get('dtefadmission/entry/{id}', [DtefAdmissionController::class, 'entry'])
    ->middleware(['auth'])
    ->name('dtefadmission.entry');

Route::get('dtefregistration/entry/{id}', [DtefRegistrationController::class, 'entry'])
    ->middleware(['auth'])
    ->name('dtefregistration.entry');

Route::get('dtefregistration/bulk', [DtefRegistrationController::class, 'bulk'])
    ->middleware(['auth'])
    ->name('dtefregistration.bulk');

Route::get('dtefresult/bulk', [DtefResultController::class, 'bulk'])
    ->middleware(['auth'])
    ->name('dtefresult.bulk');

Route::get('dtefresult/entry/{id}', [DtefResultController::class, 'entry'])
    ->middleware(['auth'])
    ->name('dtefresult.entry');

Route::get('applications/admit/{id}', [ApplicationsController::class, 'admit'])
    ->middleware(['auth'])
    ->name('applications.admit');

Route::get('applications/logs', [ApplicationsController::class, 'logsview'])
    ->middleware(['auth'])
    ->name('applications.logsview');

Route::resource('applications', ApplicationsController::class)
    ->middleware((['auth']));

Route::prefix('import_applicants')->middleware(['auth'])->group(function () {
        Route::get('/', [ImportApplicantsController::class, 'index'])->name('import_applicants.index');
        Route::get('/logs', [ImportApplicantsController::class, 'logsview'])->name('import_applicants.logsview');
    });

Route::resource('import_applicants', ImportApplicantsController::class)
    ->middleware(['auth']);

// GETS
Route::get('/pulse', [PulseController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('pulse');

Route::get('/apply/standard', [ApplyController::class, 'standard'])
    ->name('apply.standard');

Route::get('/apply/faculty', [ApplyController::class, 'facultyapplication'])
    ->name('apply.faculty');

Route::get('/apply/chatbot', [ApplyController::class, 'chatbot'])
    ->name('apply.chatbot');

Route::resource('faculty', FacultyController::class);

Route::resource('apply', ApplyController::class)
    ->middleware(['auth']);

Route::get('/get_roles', [RolesController::class, 'getRoles'])
    ->name('getroles');

Route::get('/get_courses', [CourseController::class, 'getCourses'])
    ->name('getCourses');

Route::resource('courses', CourseController::class);

require __DIR__.'/auth.php';
