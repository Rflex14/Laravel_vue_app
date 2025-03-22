<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use Inertia\Response;
use App\Http\Requests\PersonaRequest;

class PersonaController extends Controller
{
  const NUMERO_DE_OBJETOS_POR_PAGINA = 5;
  
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $personas = persona::paginate(self::NUMERO_DE_OBJETOS_POR_PAGINA);
      return inertia('Persona/Index', props: ['personas' => $personas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia('Persona/Crear');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \App\Http\Requests\PersonaRequest
     * @return \Illuminate\Http\Response
     */
    public function store(PersonaRequest $request)
    {
        Persona::create($request->validated());
        return redirect()->route('persona.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Persona $persona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * 
     */
    public function edit(Persona $persona)
    {
        return inertia('Persona/Editar', ['persona' => $persona]);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param \App\Http\Requests\PersonaRequest
     * 
     */
    public function update(PersonaRequest $request, Persona $persona)
    {
        $persona->update($request->validated());
        return redirect()->route('persona.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Persona $persona)
    {
        $persona->delete();
        return redirect()->route('persona.index');
    }
}
