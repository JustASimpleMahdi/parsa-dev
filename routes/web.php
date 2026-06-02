<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeAnnouncementController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeRequestController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\JobOpportunityController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ManagerAnnouncementController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ManagerJobRequestController;
use App\Http\Controllers\ManagerRequestController;
use App\Http\Middleware\IsEmployeeMiddleware;
use App\Http\Middleware\IsManagerMiddleware;
use App\Http\Middleware\JobNotRequestedMiddleware;
use App\Http\Middleware\JobRequestedMiddleware;
use Illuminate\Support\Facades\Route;

/* Employee */
Route::middleware(['auth', IsEmployeeMiddleware::class])->prefix('employee')->group(function () {
    Route::get('/announcements', [EmployeeAnnouncementController::class, 'index'])->name('employee.announcements.index');

    Route::resource('requests', EmployeeRequestController::class)->except(['index', 'create', 'show'])->names('employee.requests');
    Route::get('/', [EmployeeController::class, 'index'])->name('employee.index');
});

/* Manager */
Route::middleware(['auth', IsManagerMiddleware::class])->prefix('manager')->group(function () {
    Route::resource('announcements', ManagerAnnouncementController::class)->only(['index', 'store'])->names('manager.announcements');

    Route::delete('/requests/{request}/destroy', [ManagerRequestController::class, 'destroy'])->name('manager.requests.destroy');
    Route::patch('/requests/{request}/response', [ManagerRequestController::class, 'response'])->name('manager.requests.response');
    Route::get('/requests/{request}', [ManagerRequestController::class, 'show'])->name('manager.requests.show');

    Route::prefix('job-requests')->group(function () {
        Route::post('/{job_request}/reject', [ManagerJobRequestController::class, 'reject'])->name('manager.job-requests.reject');
        Route::post('/{job_request}/accept', [ManagerJobRequestController::class, 'accept'])->name('manager.job-requests.accept');
        Route::get('/{job_request}', [ManagerJobRequestController::class, 'show'])->name('manager.job-requests.show');
        Route::get('/status/{status}', [ManagerJobRequestController::class, 'index'])->name('manager.job-requests.index');
    });

    Route::get('/job-opportunities/{job_opportunity}/delete', [JobOpportunityController::class, 'delete'])->name('manager.job-opportunity.delete');
    Route::resource('job-opportunities', JobOpportunityController::class)->names('manager.job-opportunities')->except(['show', 'index']);

    Route::get('/', [ManagerController::class, 'index'])->name('manager.index');
});

/* Private Files */
Route::middleware(['auth'])->get('/personal-info/last-degree/{file}', [FileController::class, 'getPersonalInfoLastDegree'])->name('get-file.personal-info.last-degree');
Route::middleware(['auth'])->get('/resume/file/{file}', [FileController::class, 'getResumeFile'])->name('get-file.resume.file');

Route::middleware('auth')->group(function () {
    Route::put('/info/edit', [AuthController::class, 'updateInformation'])->name('job-requested.info.edit.update');
    Route::get('/info/edit', [AuthController::class, 'editInformation'])->name('job-requested.info.edit');
    Route::get('/info', [AuthController::class, 'showInformation'])->name('job-requested.info');
    Route::middleware(JobRequestedMiddleware::class)->get('/job/requested', function () {
        return view('job-requested');
    })->name('job-requested');
});

Route::middleware(['auth', JobNotRequestedMiddleware::class])->group(function () {
    Route::post('/register/resume', [AuthController::class, 'storeResumeAndJobRequest'])->name('register.resume.store');
    Route::get('/register/resume', [AuthController::class, 'registerResume'])->name('register.resume');
});

Route::middleware(JobNotRequestedMiddleware::class)->group(function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerSubmit'])->name('register-submit');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login-submit');
});
Route::delete('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/', [LandingPageController::class, 'index'])->name('index');
