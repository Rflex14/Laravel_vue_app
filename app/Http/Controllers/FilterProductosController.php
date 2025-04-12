<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
class FilterProductosController extends Controller
{
  public function index (Request $request) {
    $search = $request->input('search');
    
    $productos = Producto::when($search, function ($query, $search) {
      $query->where('nombre','like',"%{$search}%");
    })->paginate(5);
    return response()->json($productos); // Return JSON response
  }  
}
