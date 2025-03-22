<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Inertia\Response;
use App\Http\Requests\EmpresaRequest;

class EmpresaController extends Controller
{
  const NUMERO_DE_OBJETOS_POR_PAGINA = 5;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $empresas = empresa::paginate(self::NUMERO_DE_OBJETOS_POR_PAGINA);
      return inertia('Empresa/Index', props: ['empresas' => $empresas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return Inertia('Empresa/Crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmpresaRequest $request)
    {
      Empresa::create($request->validated());
      return redirect()->route('empresa.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
      return inertia('Empresa/Editar', ['empresa' => $empresa]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmpresaRequest $request, Empresa $empresa)
    {
      $empresa->update($request->validated());
      return redirect()->route('empresa.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
      $empresa->delete();
      return redirect()->route('empresa.index');
    }
}
