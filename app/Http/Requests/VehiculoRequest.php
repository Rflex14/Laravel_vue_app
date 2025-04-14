<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VehiculoRequest extends FormRequest
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
          'placa' => ['required', 'string', 'min:7', Rule::unique('vehiculos', 'placa')->ignore(request('vehiculo'), idColumn: 'id')],
          'modelo' => ['required', 'string', 'max:10'],
          'marca' => ['required', 'string', 'max:255'],
          'persona_id' => ['nullable'],
          'empresa_id' => ['nullable']
      ];
  }
  public function messages():array {
    return [
      'placa.unique' => ('Ya existe un vehiculo con esa Placa')
    ];
  }
}
