<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BackupController;
use Illuminate\Support\Facades\Auth;


Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::resource('transactions', TransactionController::class);
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
    Route::get('/backup', [BackupController::class, 'create'])->name('backup');
    Route::post('/restore', [BackupController::class, 'restore'])->name('restore');

    Route::get('/backup', [BackupController::class, 'index'])->name('backup')->middleware('auth');
    Route::get('/backup/download', [BackupController::class, 'create'])->name('backup.download')->middleware('auth');
    Route::post('/backup/restore', [BackupController::class, 'restore'])->name('backup.restore')->middleware('auth');
   
});
