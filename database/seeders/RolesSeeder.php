<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Admin-EMSA']);
        Role::create(['name' => 'Admin-DILAT']);

        Role::create(['name' => 'Gerencia de Finanzas']);
        Role::create(['name' => 'Gerencia de Ventas y Marketing']);
        Role::create(['name' => 'Gerencia de Operaciones y Logística']);
        Role::create(['name' => 'Gerencia de Recursos Humanos']);
        Role::create(['name' => 'Gerencia de Tecnología']);
        Role::create(['name' => 'Gerencia General']);
        Role::create(['name' => 'Vendedores']);

    }
}
