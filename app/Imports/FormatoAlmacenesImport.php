<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class FormatoAlmacenesImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        dd($collection);
        $registro = [
          'tipo_evento' => $collection['tipo de evento'],
          'registro_notificacion' => $collection['registro de notificacion'],
          'fecha_notificacion' => $collection['fecha de notificacion'],
          'fecha_inspeccion' => $collection['fecha de inspeccion'],
          'semana_epidemiologica' => $collection['semana epid.'],
          'almacen_nombre' => $collection['lugar o sitio donde se realiza la inspeccion (Silos, almacenes y depositos)'],
          'propietario_nombre' => $collection['nombre de la empresa inspeccionada'],
          'responsable_nombre' => $collection['responsable de la empresa'],
          'producto_nombre' => $collection['rubro o producto'],
          'cantidad_total' => $collection['cantidad total de producto'],
          'unidad' => $collection['UNIDAD DE MEDIDA (t/kg/plantas)'],
          'cantidad_nacional' => $collection['CANT. PRODUCTO NACIONAL O IMPORTADO'],
          'cantidad_afectado' => $collection['CANTIDAD  PRODUCTO   AFECTADO (t/kg/plantas)'],
          'plagas' => $collection['PLAGAS O ENFERMEDADES'],
          'medidas_recomendadas' => $collection['MEDIDAS RECOMENDADAS'],
          'fitosanitario' => $collection['POSEE CERTIFICADO FITOSANITARIO'],
          'fecha_proxima' => $collection['FECHA PROXIMA VISITA'],
          'tecnico_nombre' => $collection['TECNICO RESPONSABLE DE LA INSPECCION']
        ];
    }
}
