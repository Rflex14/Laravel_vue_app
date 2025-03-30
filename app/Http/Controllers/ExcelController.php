<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\Tecnico;
use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function almacenes() 
    {
      $tecnicos = Tecnico::get();
      $almacenes = Almacen::with('productos', 'persona', 'empresa')->get();
      return inertia('Excel/FormatoAlmacenes', props: ['almacenes' => $almacenes, 'tecnicos' => $tecnicos]);
    }
    public function almacenesCreate() {
      $tecnicos = Tecnico::get();
      $almacenes = Almacen::with('productos', 'persona', 'empresa')->get();
      return inertia('Excel/FormatoAlmacenesCrear', props: ['almacenes' => $almacenes, 'tecnicos' => $tecnicos]);
    }
    public function almacenesStore(Request $request) {
      dd('Pues si llega hasta aqui'.$request);
    }
}
