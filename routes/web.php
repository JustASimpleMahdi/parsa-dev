<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\JobNotRequestedMiddleware;
use App\Http\Middleware\JobRequestedMiddleware;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
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

Route::get('/', function () {
    return view('index');
})->name('index');
