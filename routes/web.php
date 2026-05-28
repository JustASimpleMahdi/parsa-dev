<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\JobOpportunityController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ManagerController;
use App\Http\Middleware\IsManagerMiddleware;
use App\Http\Middleware\JobNotRequestedMiddleware;
use App\Http\Middleware\JobRequestedMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', IsManagerMiddleware::class])->prefix('manager')->group(function () {
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
