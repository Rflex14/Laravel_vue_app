<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tecnico;

class TecnicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            Tecnico::create([
              'cedula' => (26658259),
              'nombre' => 'Juan',
              'apellido' => 'Román',
              'telefono' =>4167877509
            ]);
            Tecnico::create([
              'cedula' => (17584512),
              'nombre' => 'Laura',
              'apellido' => 'Prieto',
              'telefono' =>4149949828
            ]);
            Tecnico::create([
              'cedula' => (18122923),
              'nombre' => 'Natacha',
              'apellido' => 'Gallegos',
              'telefono' =>4242085000
            ]);
            Tecnico::create([
              'cedula' => (32415645),
              'nombre' => 'José',
              'apellido' => 'Torres',
              'telefono' =>4166766109
            ]);
        }   
    }

