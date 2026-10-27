<?php

use App\Http\Controllers\Api\SiswaController;
use Illuminate\Support\Facades\Route;

Route::resource('siswa', SiswaController::class);
