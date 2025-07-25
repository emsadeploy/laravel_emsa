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
        $gerencias_emsa= [
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

        $gerencias_dilat = ['Gerencia Logística', 'Gerencia de Operaciones', 'Gerencia de Ventas'];

        foreach ($gerencias_emsa as $gerencia) 
        {
            Gerency::create([
                'name'          => $gerencia,
                'description'   => 'Descripción de ' . $gerencia,
                'is_active'     => true,
                'id_empresa'       => 2, // Assuming EMSA has id_empresa = 1
            ]);
        }

        foreach ($gerencias_dilat as $gerencia) 
        {
            Gerency::create([
                'name'          => $gerencia,
                'description'   => 'Descripción de ' . $gerencia,
                'is_active'     => true,
                'id_empresa'    => 3, // Assuming DILAT has id_empresa = 2
            ]);
        }

       
    }
}
