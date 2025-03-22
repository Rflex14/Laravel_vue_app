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
      for ($i = 1; $i <= 10; $i++) {
        if ($i < 10) {
          Empresa::create([
            'rif' => 'J-'.(10000001*$i).'-'.$i,
            'nombre' => 'nombre'.$i,
            'nombre_responsable' => 'nombre_responsable'.$i,
            'cedula_responsable' => (10000001*$i),
            'telefono_responsable' =>(10000000001*$i)
          ]);
        } else {
          Empresa::create([
            'rif' => 'J-10000000-0',
            'nombre' => 'nombre10',
            'nombre_responsable' => 'nombre_responsable10',
            'cedula_responsable' => 10000000,
            'telefono_responsable' => 10000000000
          ]);
          Empresa::create([
            'rif' => 'J-11000000-0',
            'nombre' => 'nombre11',
            'nombre_responsable' => 'nombre_responsable11',
            'cedula_responsable' => 11000000,  
            'telefono_responsable' => 11000000000
          ]);
        }
      }
    }
}
