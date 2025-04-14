<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DescargaController extends Controller
{
    public function formatoAlmacenes() {
      date_default_timezone_set("America/Caracas");
      $archivo = public_path('formatos/FormatoDataAlmacenes/Formato Data de Silos, Almacenes, Depósitos 2025.xlsx');
      $fecha = date("Y-m-d");
      $hora = date("=H,i");
      if (!file_exists($archivo)) {
        return response()->json(['error' => 'El archivo no existe'], 404);
      } else {
        if(file_exists(public_path('backup/formatoAlmacenes/Formato Data de Silos, Almacenes, Depósitos_'.$fecha.$hora.'.xlsx'))) {
          unlink(public_path('backup/formatoAlmacenes/Formato Data de Silos, Almacenes, Depósitos_'.$fecha.$hora.'.xlsx'));
        }
        copy($archivo, public_path('backup/formatoAlmacenes/Formato Data de Silos, Almacenes, Depósitos_'.$fecha.$hora.'.xlsx'));
        return response()->download($archivo);
      }
    }
    public function formatoEpidemiologico() {
      date_default_timezone_set("America/Caracas");
      $archivo = public_path('formatos/Formato Data Epidemiológica/Formato Data Epidemiológica 2025.xlsx');
      $fecha = date("Y-m-d");
      $hora = date("=H,i");
      if (!file_exists($archivo)) {
        return response()->json(['error' => 'El archivo no existe'], 404);
      } else {
        if(file_exists(public_path('backup/Formato Data Epidemiológica/Formato Data Epidemiológica_'.$fecha.$hora.'.xlsx'))) {
          unlink(public_path('backup/Formato Data Epidemiológica/Formato Data Epidemiológica_'.$fecha.$hora.'.xlsx'));
        }
        copy($archivo, public_path('backup/Formato Data Epidemiológica/Formato Data Epidemiológica_'.$fecha.$hora.'.xlsx'));
        return response()->download($archivo);
      }
    }
    public function formatoVegetal() {
      date_default_timezone_set("America/Caracas");
      $archivo = public_path('formatos/FORMATO PROTECCION VEGETAL/FORMATO PROTECCION VEGETAL_2025.xlsx');
      $fecha = date("Y-m-d");
      $hora = date("=H,i");
      if (!file_exists($archivo)) {
        return response()->json(['error' => 'El archivo no existe'], 404);
      } else {
        if(file_exists(public_path('backup/FORMATO PROTECCION VEGETAL/FORMATO PROTECCION VEGETAL_'.$fecha.$hora.'.xlsx'))) {
          unlink(public_path('backup/FORMATO PROTECCION VEGETAL/FORMATO PROTECCION VEGETAL_'.$fecha.$hora.'.xlsx'));
        }
        copy($archivo, public_path('backup/FORMATO PROTECCION VEGETAL/FORMATO PROTECCION VEGETAL_'.$fecha.$hora.'.xlsx'));
        return response()->download($archivo);
      }
    }
}
