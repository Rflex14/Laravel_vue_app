<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RespaldoController extends Controller
{
    public function FormatoAlmacenes() {
      $path = public_path('backup/formatoAlmacenes');
      $archivos = array_diff(scandir($path), ['..', '.']);

      return inertia('Respaldo/formatoAlmacenes', props: ['archivos' => $archivos]);
    }
    public function FormatoEpidemiologico() {
      $path = public_path('backup/Formato Data Epidemiológica');
      $archivos = array_diff(scandir($path), ['..', '.']);

      return inertia('Respaldo/formatoEpidemiologico', props: ['archivos' => $archivos]);
    }
    public function FormatoVegetal() {
      $path = public_path('backup/FORMATO PROTECCION VEGETAL');
      $archivos = array_diff(scandir($path), ['..', '.']);

      return inertia('Respaldo/formatoVegetal', props: ['archivos' => $archivos]);
    }
}
