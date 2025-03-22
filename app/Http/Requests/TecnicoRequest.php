<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TecnicoRequest extends FormRequest
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
          'cedula' => ['required', 'numeric', 'digits:8', Rule::unique('tecnicos', 'cedula')->ignore(request('tecnico'), idColumn: 'id')],
          'nombre' => ['required', 'string', 'max:255'],
          'apellido' => ['required', 'string', 'max:255'],
          'telefono' => ['required', 'numeric', 'digits:11']
      ];
  }
  public function messages():array {
    return [
      'cedula.unique' => ('Ya existe un tecnico con esa cedula')
    ];
  }
}
