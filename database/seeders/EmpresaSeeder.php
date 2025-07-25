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
        Empresa::create(['id'=>1,'name' => 'Plataforma','description' => 'Plataforma','is_active' => true,]);
        Empresa::create(['id'=>2,'name' => 'EMSA','description' => 'Empresa EMSA','is_active' => true,]);
        Empresa::create(['id'=>3,'name' => 'DILAT','description' => 'Empresa DILAT','is_active' => true,]);
    }
}
