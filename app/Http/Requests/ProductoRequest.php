<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ProductoRequest extends FormRequest
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
          'nombre' => ['required', 'string', 'max:255', Rule::unique('productos', 'nombre')->ignore(request('producto'), idColumn: 'id')]
      ];
  }
  public function messages():array {
    return [
      'nombre.unique' => ('Ya existe un producto con ese nombre')
    ];
  }
}
