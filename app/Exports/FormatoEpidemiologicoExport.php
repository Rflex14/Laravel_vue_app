<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\IOFactory;
use Maatwebsite\Excel\Concerns\WithEvents;

class FormatoEpidemiologicoExport implements WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $tablas;
    public function __construct(array $tablas)
    {
      $this->tablas = $tablas;
    }
    public function array(): array
    {
      return [];
    }
    public function registerEvents(): array
    {
    return [
        \Maatwebsite\Excel\Events\BeforeExport::class => function (\Maatwebsite\Excel\Events\BeforeExport $event) {
            // Load your preformatted file as a template
            $templatePath = public_path('formatos/Formato Data Epidemiológica 2025.xlsx');
            $reader = IOFactory::createReader('Xlsx');
            $spreadsheet = $reader->load($templatePath);

            // Select the active sheet
            $sheet = $spreadsheet->getActiveSheet();

            // Write data into the preformatted file
            foreach ($this->tablas as $rowIndex => $row) {
                $excelRow = $rowIndex + 1; // Start at row 1 (rebuilding entire document)
                $sheet->setCellValue("A{$excelRow}", $row['tipo_evento']);
                $sheet->setCellValue("B{$excelRow}", $row['registro_notificacion']);
                $sheet->setCellValue("C{$excelRow}", $row['registro_eventos_fitosanitarios']);
                $sheet->setCellValue("D{$excelRow}", $row['fecha_notificacion']);
                $sheet->setCellValue("E{$excelRow}", $row['dia']);
                $sheet->setCellValue("F{$excelRow}", $row['mes']);
                $sheet->setCellValue("G{$excelRow}", $row['año']);
                $sheet->setCellValue("H{$excelRow}", $row['semana_epidemiologica']);
                $sheet->setCellValue("I{$excelRow}", $row['estado']);
                $sheet->setCellValue("J{$excelRow}", $row['municipio']);
                $sheet->setCellValue("K{$excelRow}", $row['parroquia']);
                $sheet->setCellValue("L{$excelRow}", $row['sector']);
                $sheet->setCellValue("M{$excelRow}", $row['tipo_lugar_inspeccion']);
                $sheet->setCellValue("N{$excelRow}", $row['unidad_direccion']);
                $sheet->setCellValue("O{$excelRow}", $row['unidad_nombre']);
                $sheet->setCellValue("P{$excelRow}", $row['producto_nombre']);
                $sheet->setCellValue("Q{$excelRow}", $row['plaga_nombre_comun']);
                $sheet->setCellValue("R{$excelRow}", $row['plaga_nombre_cientifico']);
                $sheet->setCellValue("S{$excelRow}", $row['porcentaje_infestacion']);
                $sheet->setCellValue("T{$excelRow}", $row['cantidad_inspeccionada']);
                $sheet->setCellValue("U{$excelRow}", $row['unidad']);
                $sheet->setCellValue("V{$excelRow}", $row['cantidad_afectado']);
                $sheet->setCellValue("W{$excelRow}", $row['parte_afectada']);
                $sheet->setCellValue("X{$excelRow}", $row['estado_fenologico']);
                $sheet->setCellValue("Y{$excelRow}", $row['propietario_nombre']);
                $sheet->setCellValue("Z{$excelRow}", $row['propietario_ci']);
                $sheet->setCellValue("AA{$excelRow}", $row['este']);
                $sheet->setCellValue("AB{$excelRow}", $row['norte']);
                $sheet->setCellValue("AC{$excelRow}", $row['punto_referencia']);
                $sheet->setCellValue("AD{$excelRow}", $row['nombre_laboratorio']);
                $sheet->setCellValue("AE{$excelRow}", $row['fecha_envio']);
                $sheet->setCellValue("AF{$excelRow}", $row['numero_muestras_enviadas']);
                $sheet->setCellValue("AG{$excelRow}", $row['observaciones']);
                $sheet->setCellValue("AH{$excelRow}", $row['tecnico_nombre']);
                $sheet->setCellValue("AI{$excelRow}", $row['tecnico_telefono']);
                $sheet->setCellValue("AJ{$excelRow}", $row['responsable_transcripcion']);
            }

            // Save the modified file
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save(public_path('formatos/Formato Data Epidemiológica/Formato Data Epidemiológica 2025.xlsx'));
        },
    ];
    }
}
