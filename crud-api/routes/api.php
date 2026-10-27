<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\SiswaController;
use Illuminate\Support\Facades\Route;

// Route::get('/siswa', [SiswaController::class, 'index']);

// Route::get('/siswa/{id}', [SiswaController::class, 'show']);

// Route::post('/siswa', [SiswaController::class, 'store']);

// Route::put('/siswa/{id}', [SiswaController::class, 'update']);

// Route::delete('/siswa/{id}', [SiswaController::class, 'destroy']);
Route::resource('siswa',SiswaController::class)->only('index','show','store','update','destroy');


