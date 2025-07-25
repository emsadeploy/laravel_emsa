<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gerency;

class GerencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array_gerencias= [
            'Gerencia de Finanzas',
            'Gerencia de Recursos Humanos',
            'Gerencia de Marketing',
            'Gerencia de Ventas',
            'Gerencia de Operaciones',
            'Gerencia de Tecnología',
            'Gerencia de Proyectos',
            'Gerencia de Atención al Cliente',
            'Gerencia de Logística',
            'Gerencia de Investigación y Desarrollo',
        ];

        foreach ($array_gerencias as $gerencia) {
            Gerency::create([
                'name' => $gerencia,
                'description' => 'Descripción de ' . $gerencia,
                'is_active' => true,
            ]);
        }

       
    }
}
