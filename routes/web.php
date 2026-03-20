<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusinessController;

Route::get('/', [BusinessController::class, 'index'])->name('dashboard');
Route::post('/import', [BusinessController::class, 'import'])->name('import');
Route::post('/merge-duplicates', [BusinessController::class, 'mergeDuplicates'])->name('merge.duplicates');