<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DescargaController extends Controller
{
    public function formatoAlmacenes() {

      $archivo = public_path('formatos/FormatoDataAlmacenes/Formato Data de Silos, Almacenes, Depósitos 2025.xlsx');
      $hora = time();
      if (!file_exists($archivo)) {
        return response()->json(['error' => 'El archivo no existe'], 404);
      } else {
        if(file_exists(public_path('backup/formatoAlmacenes/Formato Data de Silos, Almacenes, Depósitos'.$hora.'.xlsx'))) {
          unlink(public_path('backup/formatoAlmacenes/Formato Data de Silos, Almacenes, Depósitos'.$hora.'.xlsx'));
        }
        copy($archivo, public_path('backup/formatoAlmacenes/Formato Data de Silos, Almacenes, Depósitos'.$hora.'.xlsx'));
        return response()->download($archivo);
      }
    }
    public function formatoEpidemiologico() {
      $archivo = public_path('formatos/Formato Data Epidemiológica/Formato Data Epidemiológica 2025.xlsx');
      $hora = time();
      if (!file_exists($archivo)) {
        return response()->json(['error' => 'El archivo no existe'], 404);
      } else {
        if(file_exists(public_path('backup/Formato Data Epidemiológica/Formato Data Epidemiológica'.$hora.'.xlsx'))) {
          unlink(public_path('backup/Formato Data Epidemiológica/Formato Data Epidemiológica'.$hora.'.xlsx'));
        }
        copy($archivo, public_path('backup/Formato Data Epidemiológica/Formato Data Epidemiológica'.$hora.'.xlsx'));
        return response()->download($archivo);
      }
    }
}
