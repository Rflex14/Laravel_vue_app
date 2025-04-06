<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class FormatoEpidemiologicoImport implements ToCollection
{
    /**
    * @param Collection $collection
    */

    public $data;

    public function collection(Collection $collection)
    {
        $registros = [];
        foreach ($collection as $registro) {
          $registros[] = [
            'tipo_evento' => $registro[0],
            'registro_notificacion' => $registro[1],
            'registro_eventos_fitosanitarios' => $registro[2],
            'fecha_notificacion' => $registro[3],
            'dia' => $registro[4],
            'mes' => $registro[5],
            'año' => $registro[6],
            'semana_epidemiologica' => $registro[7],
            'estado' => $registro[8],
            'municipio' => $registro[9],
            'parroquia' => $registro[10],
            'sector' => $registro[11],
            'tipo_lugar_inspeccion' => $registro[12],
            'unidad_direccion' => $registro[13],
            'unidad_nombre' => $registro[14],
            'producto_nombre' => $registro[15],
            'plaga_nombre_comun' => $registro[16],
            'plaga_nombre_cientifico' => $registro[17],
            'porcentaje_infestacion' => $registro[18],
            'cantidad_inspeccionada' => $registro[19],
            'unidad' => $registro[20],
            'cantidad_afectado' => $registro[21],
            'parte_afectada' => $registro[22],
            'estado_fenologico' => $registro[23],
            'propietario_nombre' => $registro[24],
            'propietario_ci' => $registro[25],
            'este' => $registro[26],
            'norte' => $registro[27],
            'punto_referencia' => $registro[28],
            'nombre_laboratorio' => $registro[29],
            'fecha_envio' => $registro[30],
            'numero_muestras_enviadas' => $registro[31],
            'observaciones' => $registro[32],
            'tecnico_nombre' => $registro[33],
            'tecnico_telefono' => $registro[34],
            'responsable_transcripcion' => $registro [35]
          ];
        }
        $this->data = $registros;
    }
}
