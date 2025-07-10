<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//Custom Auth routs as per Doc
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'store']);

Route::get('login', [AuthController::class, 'loginPage'])->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::get('forgot-password', [AuthController::class, 'passwordPage'])->name('password.request');
Route::post('forgot-password', [AuthController::class, 'forgetPasswordLink'])->name('password.email');

Route::get('reset-password/{token}', [AuthController::class, 'resetPassword'])->name('password.reset');
Route::post('reset-password', [AuthController::class, 'resetPasswordSave'])->name('password.store');

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [AuthController::class, 'emailVerificationPage'])->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', [AuthController::class, 'verificationEmail'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('email/verification-notification', [AuthController::class, 'verificationLinkSend'])->middleware('throttle:6,1')->name('verification.send');

    Route::get('confirm-password', [AuthController::class, 'confirmablePasswordPage'])->name('password.confirm');
    Route::post('confirm-password', [AuthController::class, 'confirmablePasswordSave']);

    Route::put('password', [AuthController::class, 'passwordUpdate'])->name('password.update');

    Route::post('logout', [AuthController::class, 'destroy'])->name('logout');
});

Route::get('/dashboard', [InvoiceController::class,'dashboardData'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('invoices', InvoiceController::class)->names('invoices');
    Route::get('/invoices/{invoice}/pdf', [InvoiceController::class, 'downloadPdf'])->name('invoices.pdf');
    Route::post('/invoices/{invoice}/send', [InvoiceController::class, 'sendInvoice'])->name('invoices.send');
});
