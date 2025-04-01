<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\IOFactory;
use Maatwebsite\Excel\Concerns\WithEvents;

class FormatoAlmacenesExport implements WithEvents
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
            $templatePath = public_path('formatos/Formato Data de Silos, Almacenes, Depósitos 2025.xlsx');
            $reader = IOFactory::createReader('Xlsx');
            $spreadsheet = $reader->load($templatePath);

            // Select the active sheet
            $sheet = $spreadsheet->getActiveSheet();

            // Write data into the preformatted file
            foreach ($this->tablas as $rowIndex => $row) {
                $excelRow = $rowIndex + 1; // Start at row 1 (rebuilding entire document)
                $sheet->setCellValue("A{$excelRow}", $row['tipo_evento']);
                $sheet->setCellValue("B{$excelRow}", $row['registro_notificacion']);
                $sheet->setCellValue("C{$excelRow}", $row['fecha_notificacion']);
                $sheet->setCellValue("D{$excelRow}", $row['fecha_inspeccion']);
                $sheet->setCellValue("E{$excelRow}", $row['semana_epidemiologica']);
                $sheet->setCellValue("F{$excelRow}", $row['estado']);
                $sheet->setCellValue("G{$excelRow}", $row['municipio']);
                $sheet->setCellValue("H{$excelRow}", $row['parroquia']);
                $sheet->setCellValue("I{$excelRow}", $row['sector']);
                $sheet->setCellValue("J{$excelRow}", $row['almacen_nombre']);
                $sheet->setCellValue("K{$excelRow}", $row['propietario_nombre']);
                $sheet->setCellValue("L{$excelRow}", $row['rif']);
                $sheet->setCellValue("M{$excelRow}", $row['producto_nombre']);
                $sheet->setCellValue("N{$excelRow}", $row['cantidad_total']);
                $sheet->setCellValue("O{$excelRow}", $row['unidad']);
                $sheet->setCellValue("P{$excelRow}", $row['cantidad_nacional']);
                $sheet->setCellValue("Q{$excelRow}", $row['cantidad_afectado']);
                $sheet->setCellValue("R{$excelRow}", $row['plagas']);
                $sheet->setCellValue("S{$excelRow}", $row['responsable_nombre']);
                $sheet->setCellValue("T{$excelRow}", $row['responsable_ci']);
                $sheet->setCellValue("U{$excelRow}", $row['responsable_telefono']);
                $sheet->setCellValue("V{$excelRow}", $row['medidas_recomendadas']);
                $sheet->setCellValue("W{$excelRow}", $row['fitosanitario']);
                $sheet->setCellValue("X{$excelRow}", $row['fecha_proxima']);
                $sheet->setCellValue("Y{$excelRow}", $row['observaciones']);
                $sheet->setCellValue("Z{$excelRow}", $row['tecnico_nombre']);
                $sheet->setCellValue("AA{$excelRow}", $row['tecnico_telefono']);
            }

            // Save the modified file
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save(public_path('formatos/FormatoDataAlmacenes/Formato Data de Silos, Almacenes, Depósitos 2025.xlsx'));
            // old folder name Formato Data de Silos, Almacenes, Depósitos
        },
    ];
    }
}