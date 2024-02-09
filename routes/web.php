<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PulseController;
use App\Http\Controllers\ApplicationChatbotController;
use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\ApplyController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DtefController;
use App\Http\Controllers\DtefSubmissionController;
use App\Http\Controllers\RolesController;
use Illuminate\Console\Application;
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

Route::resource('dtef', DtefController::class)
    ->middleware(['auth']);

Route::get('dtefsubmission/bulk', [DtefSubmissionController::class, 'bulk'])
    ->middleware(['auth'])
    ->name('dtefsubmission.bulk');

Route::get('dtefsubmission/entry/{id}', [DtefSubmissionController::class, 'entry'])
    ->middleware(['auth'])
    ->name('dtefsubmission.entry');

Route::resource('dtefsubmission', DtefSubmissionController::class)
    ->middleware(['auth']);

Route::get('applications/admit/{id}', [ApplicationsController::class, 'admit'])
    ->middleware(['auth'])
    ->name('applications.admit');

Route::resource('applications', ApplicationsController::class)
    ->middleware((['auth']));

// GETS
Route::get('/pulse', [PulseController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('pulse');

Route::get('/apply/standard', [ApplyController::class, 'standard'])
    ->name('apply.standard');

Route::get('/apply/chatbot', [ApplyController::class, 'chatbot'])
    ->name('apply.chatbot');

Route::resource('apply', ApplyController::class)
    ->middleware(['auth']);

Route::get('/get_roles', [RolesController::class, 'getRoles'])
    ->name('getroles');

Route::get('/get_courses', [CourseController::class, 'getCourses'])
    ->name('getCourses');

Route::resource('courses', CourseController::class);

require __DIR__.'/auth.php';
