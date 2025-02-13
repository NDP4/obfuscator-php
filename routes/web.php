<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObfuscatorController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/obfuscator', [ObfuscatorController::class, 'index'])->name('obfuscator.index');
Route::post('/obfuscate', [ObfuscatorController::class, 'obfuscate'])->name('obfuscator.process');
