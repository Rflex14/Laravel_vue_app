<?php

namespace App\Http\Controllers;

use App\Exports\FormatoAlmacenesExport;
use App\Imports\FormatoAlmacenesImport;
use App\Models\Almacen;
use App\Models\Empresa;
use App\Models\Producto;
use App\Models\Tecnico;
use App\Http\Requests\ExcelDataAlmacenesRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use DateTime;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ExcelController extends Controller
{
    public $pathAlmacenes = 'formatos/FormatoDataAlmacenes/Formato Data de Silos, Almacenes, Depósitos 2025.xlsx';
    public function almacenes() 
    {
      $tablas = new FormatoAlmacenesImport;
      if (file_exists(public_path($this->pathAlmacenes))) {
        Excel::import($tablas, public_path($this->pathAlmacenes));
        $datos = $tablas->data;
      } else {
        $datos = null;
      }
      //Excel::import($tablas, public_path('formatos/Formato Data de Silos, Almacenes, Depósitos/Formato Data de Silos, Almacenes, Depósitos 2025.xlsx'));
      $tecnicos = Tecnico::get();
      $almacenes = Almacen::with('productos', 'persona', 'empresa')->get();
      return inertia('Excel/FormatoAlmacenes', props: ['almacenes' => $almacenes, 'tecnicos' => $tecnicos, 'tablas' => $datos]);
    }
    public function almacenesCreate() {
      $tecnicos = Tecnico::get();
      $almacenes = Almacen::with('productos', 'persona', 'empresa')->get();
      return inertia('Excel/FormatoAlmacenesCrear', props: ['almacenes' => $almacenes, 'tecnicos' => $tecnicos]);
    }
    public function almacenesStore(ExcelDataAlmacenesRequest $request) {
      $request->validated();

      $almacen = Almacen::find($request->almacen_id);
      $propietario = Empresa::find($request->empresa_id);
      $producto = Producto::find($request->producto_id);
      $tecnico = Tecnico::find($request->tecnico_id);

      $fechaNotificacion = DateTime::createFromFormat('Y-m-d', $request->fecha_notificacion);
      $nuevaFechaNotificacion = $fechaNotificacion->format('d/m/Y');

      $fechaInspeccion = DateTime::createFromFormat('Y-m-d', $request->fecha_inspeccion);
      $nuevaFechaInspeccion = $fechaInspeccion->format('d/m/Y');

      $fechaProxima = DateTime::createFromFormat('Y-m-d', $request->fecha_proxima);
      $nuevaFechaProxima = $fechaProxima->format('d/m/Y');

      if ($request->fitosanitario === True) {
        $fitosanitario = 'Si';
      } else {
        $fitosanitario = 'No';
      }

      $index = 0;
      $tablas = new FormatoAlmacenesImport;
      if(file_exists(public_path($this->pathAlmacenes))) {
        Excel::import($tablas, public_path($this->pathAlmacenes));
      } else {
        Excel::import($tablas, public_path('formatos/Formato Data de Silos, Almacenes, Depósitos 2025.xlsx'));
      };
      //Excel::import($tablas, public_path($request->archivo));
      foreach ($tablas->data as $fila) {
        if(!is_null($fila["tipo_evento"])) {          
          $index++;
        }
      }
      $tablas->data[$index] = [
        'tipo_evento' => $request->tipo_evento,
        'registro_notificacion' => $request->registro_notificacion,
        'fecha_notificacion' => $nuevaFechaNotificacion,
        'fecha_inspeccion' => $nuevaFechaInspeccion,
        'semana_epidemiologica' => $request->semana_epidemiologica,
        'estado' => $almacen->estado,
        'municipio' => $almacen->municipio,
        'parroquia' => $almacen->parroquia,
        'sector' => $almacen->sector,
        'almacen_nombre' => $almacen->nombre,
        'propietario_nombre' => $propietario->nombre,
        'rif' => $propietario->rif,
        'producto_nombre' => $producto->nombre,
        'cantidad_total' => $request->cantidad_total,
        'unidad' => $request->unidad,
        'cantidad_nacional' => $request->cantidad_nacional,
        'cantidad_afectado' => $request->cantidad_afectado,
        'plagas' => $request->plagas,
        'responsable_nombre' => $propietario->nombre_responsable,
        'responsable_ci' => $propietario->cedula_responsable,
        'responsable_telefono' => $propietario->telefono_responsable,
        'medidas_recomendadas' => $request->medidas_recomendadas,
        'fitosanitario' => $fitosanitario,
        'fecha_proxima' => $nuevaFechaProxima,
        'observaciones' => $request->observaciones,
        'tecnico_nombre' => $tecnico->nombre,
        'tecnico_telefono' => $tecnico->telefono
      ];

      $subset = $tablas->data;
      $export = new FormatoAlmacenesExport($subset);
      Excel::store($export, 'nombrerandom.xlsx');

      //$export = new FormatoAlmacenesExport($tablas->data);
      //$filepath = 'formatos/Formato Data de Silos, Almacenes, Depósitos/Formato Data de Silos, Almacenes, Depósitos 2025.xlsx';
      //Excel::store($export, public_path($filepath));
      
      return redirect()->route('excel.almacenes');
    }
    public function almacenesDestroy() {
      File::delete(public_path($this->pathAlmacenes));
      return redirect()->route('excel.almacenes');
    }
}
