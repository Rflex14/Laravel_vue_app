<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\IOFactory;
use Maatwebsite\Excel\Concerns\WithEvents;

class FormatoVegetalExport implements WithEvents
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
            $templatePath = public_path('formatos/FORMATO PROTECCION VEGETAL_2025.xlsx');
            $reader = IOFactory::createReader('Xlsx');
            $spreadsheet = $reader->load($templatePath);

            // Select the active sheet
            $sheet = $spreadsheet->getActiveSheet();

            // Write data into the preformatted file
            foreach ($this->tablas as $rowIndex => $row) {
                $excelRow = $rowIndex + 1; // Start at row 1 (rebuilding entire document)
                $sheet->setCellValue("A{$excelRow}", $row['semana']);
                $sheet->setCellValue("B{$excelRow}", $row['numero_acta']);
                $sheet->setCellValue("C{$excelRow}", $row['fecha']);
                $sheet->setCellValue("D{$excelRow}", $row['estado']);
                $sheet->setCellValue("E{$excelRow}", $row['municipio']);
                $sheet->setCellValue("F{$excelRow}", $row['parroquia']);
                $sheet->setCellValue("G{$excelRow}", $row['sector']);
                $sheet->setCellValue("H{$excelRow}", $row['predio']);
                $sheet->setCellValue("I{$excelRow}", $row['rubro']);
                $sheet->setCellValue("J{$excelRow}", $row['nombre_apellido_productor']);
                $sheet->setCellValue("K{$excelRow}", $row['cedula_riff']);
                $sheet->setCellValue("L{$excelRow}", $row['numero_telefono']);
                $sheet->setCellValue("M{$excelRow}", $row['hectareas_totales']);
                $sheet->setCellValue("N{$excelRow}", $row['hectareas_sembradas']);
                $sheet->setCellValue("O{$excelRow}", $row['hectareas_atendidas']);
                $sheet->setCellValue("P{$excelRow}", $row['hectareas_afectadas']);
                $sheet->setCellValue("Q{$excelRow}", $row['plaga']);
                $sheet->setCellValue("R{$excelRow}", $row['medidas']);
                $sheet->setCellValue("S{$excelRow}", $row['observaciones']);
                $sheet->setCellValue("T{$excelRow}", $row['tecnico_nombre']);
            }

            // Save the modified file
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save(public_path('formatos/FORMATO PROTECCION VEGETAL/FORMATO PROTECCION VEGETAL_2025.xlsx'));
        },
    ];
    }
}
