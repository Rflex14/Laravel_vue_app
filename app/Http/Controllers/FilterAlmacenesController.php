<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use Illuminate\Http\Request;

class FilterAlmacenesController extends Controller
{
  public function index (Request $request) {
    $search = $request->input('search');
    
    $almacenes = Almacen::with(['empresa', 'productos'])
      ->when($search, function ($query, $search) {
          $query->where('nombre','like',"%{$search}%")
            ->orWhere('estado','like',"%{$search}%")
            ->orWhere('municipio','like',"%{$search}%")
            ->orWhere('parroquia','like',"%{$search}%")
            ->orWhere('sector','like',"%{$search}%")
            ->orWhere('direccion','like',"%{$search}%")
            ->orWhereHas('empresa', function ($empresaQuery) use ($search) {
              $empresaQuery->where('nombre', 'like', "%{$search}%")
                           ->orWhere('rif', 'like', "%{$search}%");
            })
            ->orWhereHas('productos', function($productosQuery) use ($search) {
              $productosQuery->where('nombre', 'like', "%{$search}%");
            });
    })->paginate(5);
    return response()->json($almacenes); // Return JSON response
  }  
}
