<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ExcelDataAlmacenesRequest extends FormRequest
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
        'tipo_evento' => ['required', 'digits:1'],
        'registro_notificacion' => ['required', 'string', 'min:1'],
        'fecha_notificacion' => ['required', 'string', 'min:1'],
        'fecha_inspeccion' => ['required', 'string', 'min:1'],
        'semana_epidemiologica' => ['required', 'numeric', 'min:1'],
        'almacen_id' => ['required', 'numeric', 'min:1'],
        'empresa_id' => ['required', 'numeric', 'min:1'],
        'producto_id' => ['required', 'numeric', 'min:1'],
        'cantidad_total' => ['required', 'numeric', 'min:1'],
        'unidad' => ['required', 'string', 'min:1'],
        'cantidad_nacional' => ['required', 'numeric', 'lte:cantidad_total'],
        'cantidad_afectado' => ['required', 'numeric', 'lte:cantidad_total'],
        'plagas' => ['required', 'string', 'min:1'],
        'fecha_proxima' => ['required', 'string', 'min:1'],
        'tecnico_id' => ['required', 'numeric', 'min:1']
      ];
    }
}
