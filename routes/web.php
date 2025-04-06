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
  Route::delete('/excel/almacenesDelete/{index}', [ExcelController::class, 'almacenesDelete'])->name('excel.almacenesDelete');
  Route::get('/excel/formatoEpidemiologico', [ExcelController::class, 'formatoEpidemiologico'])->name('excel.epidemiologico');
  Route::get('/excel/epidemiologicoCreate', [ExcelController::class, 'epidemiologicoCreate'])->name('excel.epidemiologicoCreate');
  Route::post('/excel/epidemiologicoStore', [ExcelController::class, 'epidemiologicoStore'])->name('excel.epidemiologicoStore');
  Route::get('/excel/EpidemiologicoDestroy', [ExcelController::class, 'EpidemiologicoDestroy'])->name('excel.epidemiologicoDestroy');
  Route::delete('/excel/EpidemiologicoDelete/{index}', [ExcelController::class, 'EpidemiologicoDelete'])->name('excel.epidemiologicoDelete');
  Route::get('/descarga/formatoAlmacenes', [DescargaController::class, 'formatoAlmacenes'])->name('descarga.formatoAlmacenes');
  Route::get('/descarga/formatoEpidemiologico', [DescargaController::class, 'formatoEpidemiologico'])->name('descarga.formatoEpidemiologico');
});
