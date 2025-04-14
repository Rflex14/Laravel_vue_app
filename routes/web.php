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
use App\Http\Controllers\RespaldoController;
use App\Http\Controllers\DescargaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index']);

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', ])->group(function () {
  Route::get('/inicio', [DashboardController::class, 'dashboard'])->name('dashboard');
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
  Route::get('/excel/vegetal', [ExcelController::class, 'vegetal'])->name('excel.vegetal');
  Route::get('/excel/vegetalCreate', [ExcelController::class, 'vegetalCreate'])->name('excel.vegetalCreate');
  Route::post('/excel/vegetalStore', [ExcelController::class, 'vegetalStore'])->name('excel.vegetalStore');
  Route::get('/excel/vegetalDestroy', [ExcelController::class, 'vegetalDestroy'])->name('excel.vegetalDestroy');
  Route::delete('/excel/vegetalDelete/{index}', [ExcelController::class, 'vegetalDelete'])->name('excel.vegetalDelete');
  Route::get('/respaldo/formatoAlmacenes', [RespaldoController::class, 'formatoAlmacenes'])->name('respaldo.formatoAlmacenes');
  Route::get('/respaldo/formatoEpidemiologico', [RespaldoController::class, 'formatoEpidemiologico'])->name('respaldo.formatoEpidemiologico');
  Route::get('/respaldo/formatoVegetal', [RespaldoController::class, 'formatoVegetal'])->name('respaldo.formatoVegetal');
  Route::get('/descarga/formatoAlmacenes', [DescargaController::class, 'formatoAlmacenes'])->name('descarga.formatoAlmacenes');
  Route::get('/descarga/formatoEpidemiologico', [DescargaController::class, 'formatoEpidemiologico'])->name('descarga.formatoEpidemiologico');
  Route::get('/descarga/formatoVegetal', [DescargaController::class, 'formatoVegetal'])->name('descarga.formatoVegetal');
  Route::get('/descarga/respaldoAlmacenes/{file}', [DescargaController::class, 'respaldoAlmacenes'])->name('descarga.respaldoAlmacenes');
  Route::get('/descarga/respaldoEpidemiologico/{file}', [DescargaController::class, 'respaldoEpidemiologico'])->name('descarga.respaldoEpidemiologico');
  Route::get('/descarga/respaldoVegetal/{file}', [DescargaController::class, 'respaldoVegetal'])->name('descarga.respaldoVegetal');
});
