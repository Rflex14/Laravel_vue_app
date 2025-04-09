<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class FormatoVegetalImport implements ToCollection
{
    /**
    * @param Collection $collection
    */

    public $data;
    // Constructor to receive data
    public function collection(Collection $collection)
    {
        $registros = [];
        foreach ($collection as $registro) {
          $registros[] = [
            'semana' => $registro[0],
            'numero_acta' => $registro[1],
            'fecha' => $registro[2],
            'estado' => $registro[3],
            'municipio' => $registro[4],
            'parroquia' => $registro[5],
            'sector' => $registro[6],
            'predio' => $registro[7],
            'rubro' => $registro[8],
            'nombre_apellido_productor' => $registro[9],
            'cedula_riff' => $registro[10],
            'numero_telefono' => $registro[11],
            'hectareas_totales' => $registro[12],
            'hectareas_sembradas' => $registro[13],
            'hectareas_atendidas' => $registro[14],
            'hectareas_afectadas' => $registro[15],
            'plaga' => $registro[16],
            'medidas' => $registro[17],
            'observaciones' => $registro[18],
            'tecnico_nombre' => $registro[19]
          ];
        }
        $this->data = $registros;
    }
}
