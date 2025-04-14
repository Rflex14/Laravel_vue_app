<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Empresa;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          Empresa::create([
            'rif' => 'J-'.(25150701).'-1',
            'nombre' => 'Agrinova',
            'nombre_responsable' => 'Jacinto',
            'apellido_responsable'=> 'Colón',
            'cedula_responsable' => (32415645),
            'telefono_responsable' =>(4246766109)
          ]);
          Empresa::create([
            'rif' => 'J-'.(33755279).'-2',
            'nombre' => 'Agrosilca',
            'nombre_responsable' => 'Vivian',
            'apellido_responsable'=> 'Montano',
            'cedula_responsable' => (14869752),
            'telefono_responsable' =>(4167348046)
          ]);
          Empresa::create([
            'rif' => 'J-'.(12952072).'-3',
            'nombre' => 'Agrogan Oriente',
            'nombre_responsable' => 'Javier',
            'apellido_responsable'=> 'Ortiz',
            'cedula_responsable' => (23004072),
            'telefono_responsable' =>(4149798833)
          ]);
      }
    }

