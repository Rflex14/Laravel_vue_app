<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Persona;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      for ($i = 1; $i <= 10; $i++) {
        if ($i < 10) {
          Persona::create([
            'rif' => 'V-'.(10000001*$i).'-'.$i,
            'cedula' => (10000001*$i),
            'nombre' => 'nombre'.$i,
            'apellido' => 'apellido'.$i,
            'telefono' =>(10000000001*$i)
          ]);
        } else {
          Persona::create([
            'rif' => 'V-10000000-0',
            'cedula' => 10000000,
            'nombre' => 'nombre10',
            'apellido' => 'apellido10',
            'telefono' => 10000000000
          ]);
          Persona::create([
            'rif' => 'V-11000000-0',
            'cedula' => 11000000,
            'nombre' => 'nombre11',
            'apellido' => 'apellido11',
            'telefono' => 11000000000
          ]);
        }
      }   
    }
}
