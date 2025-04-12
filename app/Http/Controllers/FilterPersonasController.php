<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

class FilterPersonasController extends Controller
{
    public function index (Request $request) {
      $search = $request->input('search');
      
      $personas = Persona::when($search, function ($query, $search) {
        $query->where('rif','like',"%{$search}%")
              ->orWhere('cedula','like',"%{$search}%")
              ->orWhere('nombre','like',"%{$search}%")
              ->orWhere('apellido','like',"%{$search}%")
              ->orWhere('telefono','like',"%{$search}%");
      })->paginate(5);
      return response()->json($personas); // Return JSON response
    }    
}
