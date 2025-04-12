<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilterPersonasController;
use App\Http\Controllers\FilterEmpresasController;
use App\Http\Controllers\FilterProductosController;
use App\Http\Controllers\FilterTecnicosController;
use App\Http\Controllers\FilterVehiculosController;
use App\Http\Controllers\FilterUnidadesController;
use App\Http\Controllers\FilterAlmacenesController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/personas', [FilterPersonasController::class, 'index']);
Route::get('/empresas', [FilterEmpresasController::class, 'index']);
Route::get('/productos', [FilterProductosController::class, 'index']);
Route::get('/tecnicos', [FilterTecnicosController::class, 'index']);
Route::get('/vehiculos', [FilterVehiculosController::class, 'index']);
Route::get('/unidades', [FilterUnidadesController::class, 'index']);
Route::get('/almacenes', [FilterAlmacenesController::class, 'index']);