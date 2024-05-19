<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiculoController;

Route::get('/vehiculos/usuarios', [UserController::class, 'getUsuarios'])->name('api_vehiculos.getUsuarios');
Route::get('/vehiculos/usuarios/{id}', [UserController::class, 'getUsuarioId'])->name('api_vehiculos.getUsuarioId');
Route::post('/vehiculos/usuarios/create', [UserController::class, 'createUsuarios'])->name('api_vehiculos.createUsuarios');
Route::put('/vehiculos/usuarios/update', [UserController::class, 'updateUsuarios'])->name('api_vehiculos.updateUsuarios');
Route::delete('/vehiculos/usuarios/delete/{id}', [UserController::class, 'deleteUsuarios'])->name('api_vehiculos.deleteUsuarios');


Route::get('/vehiculos', [VehiculoController::class, 'getAll'])->name('api_vehiculos.getAll');
Route::get('/vehiculos/{id}', [VehiculoController::class, 'getId'])->name('api_vehiculos.getId');
Route::post('/vehiculos/create', [VehiculoController::class, 'create'])->name('api_vehiculos.create');
Route::put('/vehiculos/update/{id}', [VehiculoController::class, 'update'])->name('api_vehiculos.update');
Route::delete('/vehiculos/delete/{id}', [VehiculoController::class, 'delete'])->name('api_vehiculos.delete');