<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\SingerController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware((['auth:api']))->group(function () {
    Route::get('users', [UserController::class, 'index'])->middleware('role:admin,user');
    Route::get('users/{id}', [UserController::class, 'show'])->middleware('role:admin');
    Route::put('users/{id}', [UserController::class, 'update'])->middleware('role:admin');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->middleware('role:admin');

    Route::post('logout', [AuthController::class, 'logout']);

    //routes for singers
    Route::get('singers', [SingerController::class, 'index'])->middleware('role:admin,user');
    Route::post('singers', [SingerController::class, 'create'])->middleware('role:admin');
    Route::get('singers/{id}', [SingerController::class, 'show'])->middleware('role:admin,user');
    Route::put('singers/{id}', [SingerController::class, 'update'])->middleware('role:admin');
    Route::delete('singers/{id}', [SingerController::class, 'destroy'])->middleware('role:admin');

    //routes for songs
    Route::post('songs', [MusicController::class, 'create'])->middleware('role:admin,user');
    Route::get('songs', [MusicController::class, 'index'])->middleware('role:admin,user');
    Route::get('songs/{id}', [MusicController::class, 'show'])->middleware('role:admin,user');
    Route::put('songs/{id}', [MusicController::class, 'update'])->middleware('role:admin');
    Route::delete('songs/{id}', [MusicController::class, 'destroy'])->middleware('role:admin');

    //csv import/export

    Route::get('users-export', [UserController::class, 'export'])->middleware('role:admin');
    Route::post('users-import', [UserController::class, 'import'])->middleware('role:admin');

    Route::get('music-export', [MusicController::class, 'export'])->middleware('role:admin,user');
    Route::post('music-import', [MusicController::class, 'import'])->middleware('role:admin, user');
});
