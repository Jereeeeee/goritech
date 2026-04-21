<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CotizacionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::view('/cotiza', 'cotiza')->middleware('auth')->name('cotiza.index');
Route::post('/cotiza', [CotizacionController::class, 'store'])->middleware('auth')->name('cotiza.store');
Route::get('/administracion', [CotizacionController::class, 'index'])->middleware('auth')->name('admin.index');

Route::get('/auth', [AuthController::class, 'show'])->name('auth.show');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/auth/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
