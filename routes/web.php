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
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\DescargaController;
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
  Route::get('/excel/almacenes', [ExcelController::class, 'almacenes'])->name('excel.almacenes');
  Route::get('/excel/almacenesCreate', [ExcelController::class, 'almacenesCreate'])->name('excel.almacenesCreate');
  Route::post('/excel/almacenesStore', [ExcelController::class, 'almacenesStore'])->name('excel.almacenesStore');
  Route::get('/excel/almacenesDestroy', [ExcelController::class, 'almacenesDestroy'])->name('excel.almacenesDestroy');
  Route::get('/descarga/formatoAlmacenes/{info}', [DescargaController::class, 'formatoAlmacenes'])->where('info', '.*')->name('descarga.formatoAlmacenes');
  Route::delete('/descarga/almacenesDelete/{index}', [ExcelController::class, 'almacenesDelete'])->name('excel.almacenesDelete');
});
