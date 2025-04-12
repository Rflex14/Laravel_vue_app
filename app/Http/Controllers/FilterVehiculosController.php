<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;

class FilterVehiculosController extends Controller
{
  public function index (Request $request) {
    $search = $request->input('search');
    
    $vehiculos = Vehiculo::with(['persona', 'empresa'])
      ->when($search, function ($query, $search) {
          $query->where('placa','like',"%{$search}%")
            ->orWhere('modelo','like',"%{$search}%")
            ->orWhere('marca','like',"%{$search}%")
            ->orWhereHas('persona', function ($personaQuery) use ($search) {
              $personaQuery->where('nombre', 'like', "%{$search}%")
                           ->orWhere('rif', 'like', "%{$search}%");
            })
            ->orWhereHas('empresa', function ($empresaQuery) use ($search) {
              $empresaQuery->where('nombre', 'like', "%{$search}%")
                           ->orWhere('rif', 'like', "%{$search}%");
            });
    })->paginate(5);
    return response()->json($vehiculos); // Return JSON response
  }  
}
