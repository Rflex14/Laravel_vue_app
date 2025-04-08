<?php

namespace App\Http\Controllers;

use App\Exports\FormatoAlmacenesExport;
use App\Exports\FormatoEpidemiologicoExport;
use App\Imports\FormatoAlmacenesImport;
use App\Imports\FormatoEpidemiologicoImport;
use App\Models\Unidad_Productiva;
use App\Models\Almacen;
use App\Models\Empresa;
use App\Models\Persona;
use App\Models\Producto;
use App\Models\Tecnico;
use App\Models\Vehiculo;
use App\Http\Requests\ExcelDataAlmacenesRequest;
use App\Http\Requests\ExcelDataEpidemiologicaRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use DateTime;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\IOFactory;

use function PHPUnit\Framework\isNull;

class ExcelController extends Controller
{
    public $pathAlmacenes = 'formatos/FormatoDataAlmacenes/Formato Data de Silos, Almacenes, Depósitos 2025.xlsx';
    public $pathEpidemiologico = 'formatos/Formato Data Epidemiológica/Formato Data Epidemiológica 2025.xlsx';
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
        '$request->tipo_evento_notificacion' => $request->$request->tipo_evento_notificacion,
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
    public function almacenesDelete(int $index) {
      
      $rowIndex = $index; // Get the row index from the view
      $templatePath = public_path('formatos/FormatoDataAlmacenes/Formato Data de Silos, Almacenes, Depósitos 2025.xlsx');
  
      if (!file_exists($templatePath)) {
          return response()->json(['error' => 'Template not found'], 404);
      }
  
      // Load the preformatted file
      $reader = IOFactory::createReader('Xlsx');
      $spreadsheet = $reader->load($templatePath);
      $sheet = $spreadsheet->getActiveSheet();
  
      // Delete the specified row
      $sheet->removeRow($rowIndex+1);
  
      // Save the updated file
      $outputPath = public_path('formatos/FormatoDataAlmacenes/Formato Data de Silos, Almacenes, Depósitos 2025.xlsx');
      $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
      $writer->save($outputPath);
  
      return redirect()->route('excel.almacenes');
    }
    public function formatoEpidemiologico () {
      $tablas = new FormatoEpidemiologicoImport;
      if (file_exists(public_path($this->pathEpidemiologico))) {
        Excel::import($tablas, public_path($this->pathEpidemiologico));
        $datos = $tablas->data;
      } else {
        $datos = null;
      }
      $tecnicos = Tecnico::get();
      $almacenes = Almacen::with('productos', 'empresa')->get();
      $unidades = Unidad_Productiva::with('productos', 'persona', 'empresa');
      $vehiculos = Vehiculo::with('persona', 'empresa');
      return inertia('Excel/FormatoEpidemiologico', props: ['vehiculos' => $vehiculos,'unidades' => $unidades,'almacenes' => $almacenes, 'tecnicos' => $tecnicos, 'tablas' => $datos]);
    }
    public function epidemiologicoCreate () {
      $productos = Producto::get();
      $tecnicos = Tecnico::get();
      $almacenes = Almacen::with('productos', 'persona', 'empresa')->get();
      $unidades = Unidad_Productiva::with('productos', 'persona', 'empresa')->get();
      $vehiculos = Vehiculo::with('persona', 'empresa')->get();
      return inertia('Excel/FormatoEpidemiologicoCrear', props: ['productos' => $productos,'vehiculos' => $vehiculos,'unidades' => $unidades,'almacenes' => $almacenes, 'tecnicos' => $tecnicos]);
    }
    public function epidemiologicoStore(ExcelDataEpidemiologicaRequest $request) {
      $request->validated();

      if ($request['tipo_lugar_inspeccion'] === 'unidad') {
        $lugar = Unidad_Productiva::findOrFail($request['lugar_id']);
        $request['tipo_lugar_inspeccion'] = 'Unidad Productiva';
      } else if ($request['tipo_lugar_inspeccion'] === 'almacen') {
        $lugar = Almacen::findOrFail($request['lugar_id']);
        $request['tipo_lugar_inspeccion'] = 'Almacen';
      } else if ($request['tipo_lugar_inspeccion'] === 'vehiculo') {
        $lugar = Vehiculo::findOrFail($request['lugar_id']);
        $request['tipo_lugar_inspeccion'] = 'Vehiculo';
      } else {
        dd('what');
      }
      if (!is_Null($lugar['empresa_id'])) {
        $propietario = Empresa::find($lugar['empresa_id']);
      } else {
        $propietario = Persona::find($lugar['persona_id']);
      }
      $producto = Producto::find($request['producto_id']);
      $tecnico = Tecnico::find($request['tecnico_id']);

      $fechaNotificacion = DateTime::createFromFormat('Y-m-d', $request->fecha_notificacion);
      $nuevaFechaNotificacion = $fechaNotificacion->format('d/m/Y');

      $fecha = strtotime($request->año_mes_dia);                     
      $año = date("Y", $fecha); 
      $mes = date("m", $fecha); 
      $dia = date("d", $fecha); 

      $fechaEnvio = DateTime::createFromFormat('Y-m-d', $request->fecha_envio);
      $nuevaFechaEnvio = $fechaEnvio->format('d/m/Y');

      $index = 0;
      $tablas = new FormatoEpidemiologicoImport;
      if(file_exists(public_path($this->pathEpidemiologico))) {
        Excel::import($tablas, public_path($this->pathEpidemiologico));
      } else {
        Excel::import($tablas, public_path('formatos/Formato Data Epidemiológica 2025.xlsx'));
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
      'registro_eventos_fitosanitarios' => $request->registro_eventos_fitosanitarios,
      'fecha_notificacion' => $nuevaFechaNotificacion,
      'dia' => $dia,
      'mes' => $mes,
      'año' => $año,
      'semana_epidemiologica' => $request->semana_epidemiologica,
      'estado' => $lugar->estado? $lugar->estado : '',              // Y si es vehiculo?
      'municipio' => $lugar->municipio? $lugar->municipio : '',        // Y si es vehiculo?
      'parroquia' => $lugar->parroquia? $lugar->parroquia : '',        // Y si es vehiculo?
      'sector' => $lugar->sector? $lugar->sector : '',              // Y si es vehiculo?
      'tipo_lugar_inspeccion' => $request->tipo_lugar_inspeccion,
      'unidad_direccion' => $lugar->direccion? $lugar->direccion : '',                    // Y si es vehiculo?
      'unidad_nombre' => $lugar->nombre? $lugar->nombre : $lugar->placa,                           // Y si es vehiculo?
      'producto_nombre' => $producto->nombre,
      'plaga_nombre_comun' => $request->plaga_nombre_comun,
      'plaga_nombre_cientifico' => $request->plaga_nombre_cientifico,
      'porcentaje_infestacion' => $request->porcentaje_infestacion,
      'cantidad_inspeccionada' => $request->cantidad_inspeccionada,
      'unidad' => $request->unidad,
      'cantidad_afectado' => $request->cantidad_afectado,
      'parte_afectada' => $request->parte_afectada,
      'estado_fenologico' => $request->estado_fenologico,
      'propietario_nombre' => $propietario->nombre,
      'propietario_ci' => $propietario->rif,
      'este' => $lugar->este? $lugar->este : '',                 // Y si es vehiculo?
      'norte' => $lugar->norte? $lugar->norte : '',               // Y si es vehiculo?
      'punto_referencia' => $request->punto_referencia,
      'nombre_laboratorio' => $request->nombre_laboratorio,
      'fecha_envio' => $nuevaFechaEnvio,
      'numero_muestras_enviadas' => $request->numero_muestras_enviadas,
      'observaciones' => $request->observaciones,
      'tecnico_nombre' => $tecnico->nombre,
      'tecnico_telefono' => $tecnico->telefono,
      'responsable_transcripcion' => $request->responsable_transcripcion
      ];

      $subset = $tablas->data;
      $export = new FormatoEpidemiologicoExport($subset);
      Excel::store($export, 'nombrerandom.xlsx');
      
      return redirect()->route('excel.epidemiologico');

    }
    public function epidemiologicoDestroy() {
      File::delete(public_path($this->pathEpidemiologico));
      return redirect()->route('excel.epidemiologico');
    }
    public function epidemiologicoDelete(int $index) {
      $rowIndex = $index; // Get the row index from the view
      $templatePath = public_path($this->pathEpidemiologico);
  
      if (!file_exists($templatePath)) {
          return response()->json(['error' => 'Template not found'], 404);
      }
  
      // Load the preformatted file
      $reader = IOFactory::createReader('Xlsx');
      $spreadsheet = $reader->load($templatePath);
      $sheet = $spreadsheet->getActiveSheet();
  
      // Delete the specified row
      $sheet->removeRow($rowIndex+1);
  
      // Save the updated file
      $outputPath = public_path($this->pathEpidemiologico);
      $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
      $writer->save($outputPath);
  
      return redirect()->route('excel.epidemiologico');
    }
}
