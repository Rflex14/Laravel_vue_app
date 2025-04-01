<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Empresa;
use App\Models\Producto;
use App\Models\Almacen;
use Illuminate\Http\Request;
use App\Http\Requests\AlmacenRequest;

class AlmacenController extends Controller
{ 
  const NUMERO_DE_OBJETOS_POR_PAGINA = 5;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $almacenes = Almacen::with('productos', 'empresa')->paginate(self::NUMERO_DE_OBJETOS_POR_PAGINA);
      return inertia('Almacen/Index', props: ['almacenes' => $almacenes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $empresas = Empresa::all();
      $productos = Producto::all();
      return Inertia('Almacen/Crear', props: ['empresas' => $empresas, 'productos' => $productos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlmacenRequest $request)
    {
      $productos = $request->productos;
      $almacen = Almacen::create($request->validated());
      $almacen->productos()->attach($productos);
      return redirect()->route('almacen.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Almacen $almacen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Int $almacen)
    {
      $_almacen = Almacen::with('productos')->get()->findOrFail($almacen);

      $empresas = Empresa::all();
      $productos = Producto::all();
      return inertia('Almacen/Editar', ['almacen' => $_almacen, 'empresas' => $empresas, 'productos' => $productos]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AlmacenRequest $request, Int $almacen)
    {
      $_almacen = Almacen::find($almacen);
      $_almacen->update($request->validated());

      $productosIds = array_map(function ($producto) {
        return is_array($producto) && isset($producto['id']) ? $producto['id'] : $producto;
      }, $request->productos);

      $_almacen->productos()->sync($productosIds);
      
      return redirect()->route('almacen.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Almacen $almacen)
    {
      $almacen->delete();
      return redirect()->route('almacen.index');
    }
}
