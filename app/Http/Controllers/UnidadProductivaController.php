<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Empresa;
use App\Models\Producto;
use App\Models\Unidad_Productiva;
use Illuminate\Http\Request;
use Inertia\Response;
use App\Http\Requests\UnidadProductivaRequest;

class UnidadProductivaController extends Controller
{
  const NUMERO_DE_OBJETOS_POR_PAGINA = 5;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $unidades_productivas = Unidad_Productiva::with('productos', 'persona', 'empresa')->paginate(self::NUMERO_DE_OBJETOS_POR_PAGINA);
      //dd($unidades_productivas);
      return inertia('Unidad_Productiva/Index', props: ['unidades_productivas' => $unidades_productivas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $personas = Persona::all();
      $empresas = Empresa::all();
      $productos = Producto::all();
      return Inertia('Unidad_Productiva/Crear', props: ['personas' => $personas, 'empresas' => $empresas, 'productos' => $productos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UnidadProductivaRequest $request)
    {
      $productos = $request->productos;
      $UnidadProductiva = Unidad_Productiva::create($request->validated());
      $UnidadProductiva->productos()->attach($productos);
      return redirect()->route('unidadProductiva.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unidad_Productiva $unidad_Productiva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Int $unidad_Productiva)
    {
      $unidad = Unidad_Productiva::with('productos')->get()->findOrFail($unidad_Productiva);

      $personas = Persona::all();
      $empresas = Empresa::all();
      $productos = Producto::all();
      return inertia('Unidad_Productiva/Editar', ['unidad_productiva' => $unidad, 'personas' => $personas, 'empresas' => $empresas, 'productos' => $productos]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UnidadProductivaRequest $request, Int $unidad_Productiva)
    {
      
      $unidad = Unidad_Productiva::find($unidad_Productiva);
      $unidad->update($request->validated());

      $productosIds = array_map(function ($producto) {
        return is_array($producto) && isset($producto['id']) ? $producto['id'] : $producto;
      }, $request->productos);
    
      $unidad->productos()->sync($productosIds);

      return redirect()->route('unidadProductiva.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Int $unidad_Productiva)
    {
      $unidad = Unidad_Productiva::find($unidad_Productiva);
      $unidad->delete();
      return redirect()->route('unidadProductiva.index');
    }
}
