<?php

namespace App\Http\Controllers;

use App\Models\Tecnico;
use App\Http\Requests\UpdateTecnicoRequest;
use Inertia\Response;
use App\Http\Requests\TecnicoRequest;

class TecnicoController extends Controller
{
  const NUMERO_DE_OBJETOS_POR_PAGINA = 5;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $tecnicos = tecnico::paginate(self::NUMERO_DE_OBJETOS_POR_PAGINA);
      return inertia('Tecnico/Index', props: ['tecnicos' => $tecnicos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return Inertia('Tecnico/Crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TecnicoRequest $request)
    {
      Tecnico::create($request->validated());
      return redirect()->route('tecnico.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tecnico $tecnico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tecnico $tecnico)
    {
      return inertia('Tecnico/Editar', ['tecnico' => $tecnico]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(TecnicoRequest $request, Tecnico $tecnico)
    {
      $tecnico->update($request->validated());
      return redirect()->route('tecnico.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tecnico $tecnico)
    {
      $tecnico->delete();
      return redirect()->route('tecnico.index');
    }
}
