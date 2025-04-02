<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DescargaController extends Controller
{
    public function formatoAlmacenes($info) {

      $archivo = public_path(urldecode($info));

      if (!file_exists($archivo)) {
        return response()->json(['error' => 'El archivo no existe'], 404);
      } else {
        return response()->download($archivo);
      }
    }
}
