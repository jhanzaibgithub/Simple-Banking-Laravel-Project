<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/register', [AuthController::class, 'showRegistrationForm']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

// Account Operations Routes
Route::middleware('auth')->group(function () {
    Route::get('/home', [AccountController::class, 'index']);// web.php
    Route::get('/deposit', [AccountController::class, 'showDepositForm'])->name('deposit.form');
    Route::post('/deposit', [AccountController::class, 'deposit'])->name('deposit');
    route::get('/withdraw', [AccountController::class, 'showWithdrawForm'])->name('withdraw.form');
    Route::post('/withdraw', [AccountController::class, 'withdraw'])->name('withdraw');
    route::get('/transfer', [AccountController::class, 'showTransferForm'])->name('transfer.form');
    Route::post('/transfer', [AccountController::class, 'transfer'])->name('transfer');
    Route::get('/statement', [AccountController::class, 'statement']);
});
