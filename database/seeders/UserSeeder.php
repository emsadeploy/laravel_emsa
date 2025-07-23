<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuarios = [
            [
                'name' => 'Carlos',
                'ap_paterno' => 'Pérez',
                'ap_materno' => 'López',
                'nr_rut' => '11111111-1',
                'nr_telefono' => '912345678',
                'nr_cargo' => 1,
                'nr_gerencia' => 1,
                'str_empresa' => 'EMSA',
                'email' => 'carlos@example.com',
                'role' => 'Admin',
            ],
            [
                'name' => 'Lucía',
                'ap_paterno' => 'Martínez',
                'ap_materno' => 'Soto',
                'nr_rut' => '22222222-2',
                'nr_telefono' => '912345679',
                'nr_cargo' => 2,
                'nr_gerencia' => 2,
                'str_empresa' => 'DILAT',
                'email' => 'lucia@example.com',
                'role' => 'Admin-DILAT',
            ],
            [
                'name' => 'Fernando',
                'ap_paterno' => 'Gómez',
                'ap_materno' => 'Reyes',
                'nr_rut' => '33333333-3',
                'nr_telefono' => '912345680',
                'nr_cargo' => 3,
                'nr_gerencia' => 3,
                'str_empresa' => 'EMSA',
                'email' => 'fernando@example.com',
                'role' => 'Admin-EMSA',
            ],
            [
                'name' => 'Marcela',
                'ap_paterno' => 'Ramírez',
                'ap_materno' => 'Torres',
                'nr_rut' => '44444444-4',
                'nr_telefono' => '912345681',
                'nr_cargo' => 4,
                'nr_gerencia' => 4,
                'str_empresa' => 'EMSA',
                'email' => 'marcela@example.com',
                'role' => 'Gerencia de Finanzas',
            ],
            [
                'name' => 'Diego',
                'ap_paterno' => 'Contreras',
                'ap_materno' => 'Rojas',
                'nr_rut' => '55555555-5',
                'nr_telefono' => '912345682',
                'nr_cargo' => 5,
                'nr_gerencia' => 5,
                'str_empresa' => 'DILAT',
                'email' => 'diego@example.com',
                'role' => 'Gerencia de Tecnología',
            ],
            [
                'name' => 'Valentina',
                'ap_paterno' => 'Moya',
                'ap_materno' => 'Sanhueza',
                'nr_rut' => '66666666-6',
                'nr_telefono' => '912345683',
                'nr_cargo' => 6,
                'nr_gerencia' => 6,
                'str_empresa' => 'EMSA',
                'email' => 'valentina@example.com',
                'role' => 'Gerencia de Ventas y Marketing',
            ],
            [
                'name' => 'Andrés',
                'ap_paterno' => 'Navarro',
                'ap_materno' => 'Ibarra',
                'nr_rut' => '77777777-7',
                'nr_telefono' => '912345684',
                'nr_cargo' => 7,
                'nr_gerencia' => 7,
                'str_empresa' => 'EMSA',
                'email' => 'andres@example.com',
                'role' => 'Gerencia de Recursos Humanos',
            ],
            [
                'name' => 'Camila',
                'ap_paterno' => 'Herrera',
                'ap_materno' => 'Gallardo',
                'nr_rut' => '88888888-8',
                'nr_telefono' => '912345685',
                'nr_cargo' => 8,
                'nr_gerencia' => 8,
                'str_empresa' => 'DILAT',
                'email' => 'camila@example.com',
                'role' => 'Gerencia de Operaciones y Logística',
            ],
            [
                'name' => 'Javier',
                'ap_paterno' => 'Vega',
                'ap_materno' => 'Muñoz',
                'nr_rut' => '99999999-9',
                'nr_telefono' => '912345686',
                'nr_cargo' => 9,
                'nr_gerencia' => 9,
                'str_empresa' => 'DILAT',
                'email' => 'javier@example.com',
                'role' => 'Gerencia General',
            ],
            [
                'name' => 'Sofía',
                'ap_paterno' => 'Silva',
                'ap_materno' => 'Bravo',
                'nr_rut' => '10101010-0',
                'nr_telefono' => '912345687',
                'nr_cargo' => 10,
                'nr_gerencia' => 10,
                'str_empresa' => 'EMSA',
                'email' => 'sofia@example.com',
                'role' => 'Vendedores',
            ],
        ];

        foreach ($usuarios as $data) {
            $user = User::create([
                'name' => $data['name'],
                'ap_paterno' => $data['ap_paterno'],
                'ap_materno' => $data['ap_materno'],
                'nr_rut' => $data['nr_rut'],
                'nr_telefono' => $data['nr_telefono'],
                'nr_cargo' => $data['nr_cargo'],
                'nr_gerencia' => $data['nr_gerencia'],
                'str_empresa' => $data['str_empresa'],
                'email' => $data['email'],
                'password' => bcrypt('12345678'),
            ]);

            $user->assignRole($data['role']);
        }
    }
}