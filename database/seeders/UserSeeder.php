<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Enrique Nieto',
                'email' => 'admin@ferreteria.test',
                'password' => 'password',
                'role' => 'admin',
            ],
            [
                'name' => 'Laura Martínez',
                'email' => 'direccion@ferreteria.test',
                'password' => 'password',
                'role' => 'admin',
            ],
            [
                'name' => 'Carlos Ramos',
                'email' => 'almacen@ferreteria.test',
                'password' => 'password',
                'role' => 'employee',
            ],
            [
                'name' => 'Marta Sánchez',
                'email' => 'ventas@ferreteria.test',
                'password' => 'password',
                'role' => 'employee',
            ],
            [
                'name' => 'Iván García',
                'email' => 'compras@ferreteria.test',
                'password' => 'password',
                'role' => 'employee',
            ],
            [
                'name' => 'Sara López',
                'email' => 'mostrador@ferreteria.test',
                'password' => 'password',
                'role' => 'employee',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
