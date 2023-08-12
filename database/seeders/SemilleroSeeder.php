<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Semillero;

class SemilleroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Insertar datos en la tabla semilleros
        Semillero::create([
            'id_semillero'=>'1',
            'sede' => 'Sede 1',
            'nombre' => 'Semillero 1',
            'correo' => 'correo1@example.com',
            'logo' => 'logo1.jpg',
            'descripcion' => 'Descripción del Semillero 1',
            'mision' => 'Misión del Semillero 1',
            'vision' => 'Visión del Semillero 1',
            'valores' => 'Valores del Semillero 1',
            'objetivos' => 'Objetivos del Semillero 1',
            'lineas_inv' => 'Líneas de investigación del Semillero 1',
            'presentacion' => 'Presentación del Semillero 1',
            'fecha_creacion' => now(),
            'num_res' => '12345',
            'resolucion' => 'Resolución del Semillero 1',
        ]);
    }
}
