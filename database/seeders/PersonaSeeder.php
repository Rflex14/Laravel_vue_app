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
          Persona::create([
            'rif' => 'V-'.(19668100).'-1',
            'cedula' => (19668100),
            'nombre' => 'Servio',
            'apellido' => 'Merino ',
            'telefono' =>(4240782794)
          ]);
          Persona::create([
            'rif' => 'V-'.(16727975).'-2',
            'cedula' => (16727975),
            'nombre' => 'Emil',
            'apellido' => 'Medina ',
            'telefono' =>(4163791384)
          ]);
          Persona::create([
            'rif' => 'V-'.(26556381).'-3',
            'cedula' => (26556381),
            'nombre' => 'Osmán',
            'apellido' => 'Rolón',
            'telefono' =>(4248073990)
          ]);
          Persona::create([
            'rif' => 'V-'.(57293333).'-4',
            'cedula' => (57293333),
            'nombre' => 'Hugo',
            'apellido' => 'Rodrígez',
            'telefono' =>(4146773110)
          ]);
          Persona::create([
            'rif' => 'V-'.(33000097).'-5',
            'cedula' => (33000097),
            'nombre' => 'Valeria',
            'apellido' => 'Rivero',
            'telefono' =>(4243299046)
          ]);   
          Persona::create([
            'rif' => 'V-'.(29944285).'-6',
            'cedula' => (29944285),
            'nombre' => 'Geremías ',
            'apellido' => 'Brito',
            'telefono' =>(4164867994)
          ]);          
      }   
    }

