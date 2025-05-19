<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;

// Auth bawaan Laravel
Auth::routes();

/*
|--------------------------------------------------------------------------
| Login & Logout (Jika menggunakan LoginController manual)
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Semua route yang membutuhkan autentikasi
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Beranda / Home
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Dashboard User biasa
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    // Resource Transaksi untuk user biasa
    Route::resource('transactions', TransactionController::class);

    // Laporan user
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');

    // Backup & Restore
    Route::get('/backup', [BackupController::class, 'index'])->name('backup');
    Route::get('/backup/download', [BackupController::class, 'create'])->name('backup.download');
    Route::post('/backup/restore', [BackupController::class, 'restore'])->name('backup.restore');

    /*
    |--------------------------------------------------------------------------
    | Semua route untuk ADMIN (dengan middleware 'admin')
    |--------------------------------------------------------------------------
    */
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {

        // Dashboard Admin
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // CRUD User
        Route::get('/users', [AdminController::class, 'listUsers'])->name('users.index');
        Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
        Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');

        // Kelola transaksi per user
        Route::get('/users/{id}/transactions', [AdminController::class, 'userTransactions'])->name('users.transactions');

        // CRUD Transaksi Admin
        Route::get('/transactions/{id}/edit', [AdminController::class, 'editTransaction'])->name('transactions.edit');
        Route::put('/transactions/{id}', [AdminController::class, 'updateTransaction'])->name('transactions.update');
        Route::delete('/transactions/{id}', [AdminController::class, 'deleteTransaction'])->name('transactions.delete');
    });
});