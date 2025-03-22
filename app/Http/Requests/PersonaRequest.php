<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PersonaRequest extends FormRequest
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
            'rif' => ['required', 'string', 'min:10', 'max:13', Rule::unique('personas', 'rif')->ignore(request('persona'), idColumn: 'id')],
            'cedula' => ['required', 'numeric', 'digits:8', Rule::unique('personas', 'cedula')->ignore(request('persona'), idColumn: 'id')],
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'numeric', 'digits:11']
        ];
    }
    public function messages():array {
      return [
        'rif.unique' => ('Ya existe una persona con ese Rif'),
        'cedula.unique' => ('Ya existe una persona con esa Cedula')
      ];
    }
}
