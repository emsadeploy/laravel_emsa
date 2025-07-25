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

        //Roles EMSA
        
        Role::create(['name' => 'Admin','id_empresa'                                => 1]);
        Role::create(['name' => 'Admin-EMSA','id_empresa'                           => 2]);
        Role::create(['name' => 'Gerencia de Finanzas','id_empresa'                 => 2]);
        Role::create(['name' => 'Gerencia de Ventas y Marketing','id_empresa'       => 2]);
        Role::create(['name' => 'Gerencia de Operaciones y Logística', 'id_empresa' => 2]);
        Role::create(['name' => 'Gerencia de Recursos Humanos', 'id_empresa'        => 2]);
        Role::create(['name' => 'Gerencia de Tecnología', 'id_empresa'              => 2]);
        Role::create(['name' => 'Gerencia General', 'id_empresa'                    => 2]);

        //Roles DILAT
        Role::create(['name' => 'Admin-DILAT','id_empresa'                          => 3]);
        Role::create(['name' => 'Vendedores', 'id_empresa'                          => 3]);



    }
}
