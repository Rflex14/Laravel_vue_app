<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tecnico;
class FilterTecnicosController extends Controller
{
  public function index (Request $request) {
    $search = $request->input('search');
    
    $tecnicos = Tecnico::when($search, function ($query, $search) {
      $query->where('cedula','like',"%{$search}%")
            ->orWhere('nombre','like',"%{$search}%")
            ->orWhere('apellido','like',"%{$search}%")
            ->orWhere('telefono','like',"%{$search}%");
    })->paginate(5);
    return response()->json($tecnicos); // Return JSON response
  }  
}
