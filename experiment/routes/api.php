<?php

use App\Http\Controllers\Api\SiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/siswa',[SiswaController::class, 'index']);
Route::get('/siswa/{id}',[SiswaController::class, 'show']);

