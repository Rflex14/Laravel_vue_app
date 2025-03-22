<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class EmpresaRequest extends FormRequest
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
            'rif' => ['required', 'string', 'min:10','max:12', Rule::unique('empresas', 'rif')->ignore(request('empresa'), idColumn: 'id')],
            'nombre' => ['required', 'string', 'max:255'],
            'nombre_responsable' => ['required', 'string', 'max:255'],
            'cedula_responsable' => ['required', 'numeric', 'digits:8'],
            'telefono_responsable' => ['required', 'numeric', 'digits:11']
        ];
    }
    public function messages():array {
      return [
        'rif.unique' => ('Ya existe una empresa con ese Rif')
      ];
    }
}
