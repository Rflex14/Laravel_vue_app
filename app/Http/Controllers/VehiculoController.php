<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Persona;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Inertia\Response;
use App\Http\Requests\VehiculoRequest;

class VehiculoController extends Controller
{
  const NUMERO_DE_OBJETOS_POR_PAGINA = 5;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $vehiculos = Vehiculo::with('persona', 'empresa')->paginate(self::NUMERO_DE_OBJETOS_POR_PAGINA);
      return inertia('Vehiculo/Index', props: ['vehiculos' => $vehiculos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $personas = Persona::all();
      $empresas = Empresa::all();
      return Inertia('Vehiculo/Crear', props: ['personas' => $personas, 'empresas' => $empresas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehiculoRequest $request)
    {
      Vehiculo::create($request->validated());
      return redirect()->route('vehiculo.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehiculo $vehiculo)
    {
      $personas = Persona::all();
      $empresas = Empresa::all();
      return inertia('Vehiculo/Editar', ['vehiculo' => $vehiculo, 'personas' => $personas, 'empresas' => $empresas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VehiculoRequest $request, Vehiculo $vehiculo)
    {
      $vehiculo->update($request->validated());
      return redirect()->route('vehiculo.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehiculo $vehiculo)
    {
      $vehiculo->delete();
      return redirect()->route('vehiculo.index');
    }
}
