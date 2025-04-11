<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExcelProteccionVegetalRequest extends FormRequest
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
          'semana' => ['required', 'digits:1'],
          'numero_acta' => ['required', 'numeric', 'digits-between:1,32'],
          'fecha' => ['required', 'string', 'min:1'],
          'unidad_id' => ['required', 'numeric', 'min:1'],
          'rubro_id' => ['required', 'numeric', 'min:1'],
          'hectareas_totales' => ['required', 'numeric', 'min:1'],
          'hectareas_sembradas' => ['required', 'numeric', 'min:1'],
          'hectareas_atendidas' => ['required', 'numeric', 'min:1'],
          'hectareas_afectadas' => ['required', 'numeric', 'digits-between:1,32'],
          'plaga' => ['required', 'string', 'min:1'],
          'medidas' => ['required', 'string', 'min:1'],
          'observaciones' => ['required', 'string', 'min:1'],
          'tecnico_id' => ['required', 'numeric', 'min:1']
        ];
    }
}
