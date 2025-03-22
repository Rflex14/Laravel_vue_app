<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Inertia\Response;
use App\Http\Requests\ProductoRequest;

class ProductoController extends Controller
{
  const NUMERO_DE_OBJETOS_POR_PAGINA = 5;
  
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $productos = producto::paginate(self::NUMERO_DE_OBJETOS_POR_PAGINA);
      return inertia('Producto/Index', props: ['productos' => $productos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return Inertia('Producto/Crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductoRequest $request)
    {
      Producto::create($request->validated());
      return redirect()->route('producto.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
      return inertia('Producto/Editar', ['producto' => $producto]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductoRequest $request, Producto $producto)
    {
      $producto->update($request->validated());
      return redirect()->route('producto.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
      $producto->delete();
      return redirect()->route('producto.index');
    }
}
