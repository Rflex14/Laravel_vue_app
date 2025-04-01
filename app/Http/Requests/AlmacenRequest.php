<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AlmacenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
      return [
          'nombre' => ['required', 'string', 'max:255', Rule::unique('almacenes', 'nombre')->ignore(request('almacen'), 'id')],
          'estado' => ['required', 'string', 'max:32'],
          'municipio' => ['required', 'string', 'max:255'],
          'parroquia' => ['required', 'string', 'max:255'],
          'sector' => ['required', 'string', 'max:255'],
          'direccion' => ['required', 'string', 'max:255'],
          'cantidadMaxima' => ['required', 'numeric'],
          'unidad' => ['required', 'string'],
          'persona_id' => ['nullable'],
          'empresa_id' => ['nullable']
      ];
  }
  public function messages():array {
    return [
      'nombre.unique' => ('Ya existe un almacen con ese nombre')
    ];
  }
}
