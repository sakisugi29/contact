<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/store', [ContactController::class, 'store']);
Route::get('/thanks', [ContactController::class, 'thanks']);

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/export', [AdminController::class, 'export'])->name('admin.export');
    Route::delete('/admin/{contact}', [AdminController::class, 'destroy'])->name('admin.destroy');
});
