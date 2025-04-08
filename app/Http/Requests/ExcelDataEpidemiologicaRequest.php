<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExcelDataEpidemiologicaRequest extends FormRequest
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
          'registro_eventos_fitosanitarios' => ['required', 'string', 'min:1'],
          'fecha_notificacion' => ['required', 'string', 'min:1'],
          'año_mes_dia' => ['required', 'string', 'min:1'],
          'semana_epidemiologica' => ['required', 'digits:1'],
          'tipo_lugar_inspeccion' => ['required', 'string', 'min:1'],
          'lugar_id' => ['required', 'digits:1'],
          'producto_id' => ['required', 'digits:1'],
          'plaga_nombre_comun' => ['required', 'string', 'min:1'],
          'plaga_nombre_cientifico' => ['required', 'string', 'min:1'],
          'porcentaje_infestacion' => ['required', 'digits:1'],
          'cantidad_inspeccionada' => ['required', 'numeric', 'min:1'],
          'unidad' => ['required', 'string', 'min:1'],
          'cantidad_afectado' => ['required', 'numeric', 'lte:cantidad_inspeccionada'],
          'parte_afectada' => ['required', 'string', 'min:1'],
          'estado_fenologico' => ['required', 'string', 'min:1'],
          'propietario_id' => ['required', 'digits:1'],
          'punto_referencia' => ['required', 'string', 'min:1'],
          'nombre_laboratorio' => ['required', 'string', 'min:1'],
          'fecha_envio' => ['required', 'string', 'min:1'],
          'numero_muestras_enviadas' => ['required', 'digits:1'],
          'observaciones' => ['required', 'string', 'min:1'],
          'tecnico_id' => ['required', 'digits:1'],
          'responsable_transcripcion' => ['required', 'string', 'min:1']
        ];
    }
}
