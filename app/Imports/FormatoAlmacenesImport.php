<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class FormatoAlmacenesImport implements ToCollection
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
            'fecha_notificacion' => $registro[2],
            'fecha_inspeccion' => $registro[3],
            'semana_epidemiologica' => $registro[4],
            'estado' => $registro[5],
            'municipio' => $registro[6],
            'parroquia' => $registro[7],
            'sector' => $registro[8],
            'almacen_nombre' => $registro[9],
            'propietario_nombre' => $registro[10],
            'rif' => $registro[11],
            'producto_nombre' => $registro[12],
            'cantidad_total' => $registro[13],
            'unidad' => $registro[14],
            'cantidad_nacional' => $registro[15],
            'cantidad_afectado' => $registro[16],
            'plagas' => $registro[17],
            'responsable_nombre' => $registro[18],
            'responsable_ci' => $registro[19],
            'responsable_telefono' => $registro[20],
            'medidas_recomendadas' => $registro[21],
            'fitosanitario' => $registro[22],
            'fecha_proxima' => $registro[23],
            'observaciones' => $registro[24],
            'tecnico_nombre' => $registro[25],
            'tecnico_telefono' => $registro[26]
          ];
        }
        $this->data = $registros;
    }
}
