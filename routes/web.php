<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\TecnicoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\UnidadProductivaController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\AlmacenProductoController;
use App\Http\Controllers\UnidadProductivaProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index']);

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', ])->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
  Route::resource('/persona', PersonaController::class);
  Route::resource('/empresa', EmpresaController::class);
  Route::resource('/producto', ProductoController::class);
  Route::resource('/tecnico', TecnicoController::class);
  Route::resource('/vehiculo', VehiculoController::class);
  Route::resource('/unidadProductiva', UnidadProductivaController::class);
  Route::resource('/almacen', AlmacenController::class);
  Route::resource('/almacenProducto', AlmacenProductoController::class);
  Route::resource('/unidadProductivaProducto', UnidadProductivaProductoController::class);
});
