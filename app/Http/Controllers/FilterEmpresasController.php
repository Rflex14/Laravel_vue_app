<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
class FilterEmpresasController extends Controller
{
  public function index (Request $request) {
    $search = $request->input('search');
    
    $empresas = Empresa::when($search, function ($query, $search) {
      $query->where('rif','like',"%{$search}%")
            ->orWhere('nombre','like',"%{$search}%")
            ->orWhere('nombre_responsable','like',"%{$search}%")
            ->orWhere('apellido_responsable','like',"%{$search}%")
            ->orWhere('cedula_responsable','like',"%{$search}%")
            ->orWhere('telefono_responsable','like',"%{$search}%");
    })->paginate(5);
    return response()->json($empresas); // Return JSON response
  }  
}
