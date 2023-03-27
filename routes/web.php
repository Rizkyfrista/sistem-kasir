<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\TransaksiController::class, 'index']);

Route::resource('transactions', TransaksiController::class);
Route::resource('karyawans', KaryawanController::class);
Route::resource('items', ItemController::class);
