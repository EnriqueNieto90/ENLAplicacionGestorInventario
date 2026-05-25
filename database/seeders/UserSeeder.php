<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuario administrador: podrá gestionar artículos y stock
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@inventario.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Usuario empleado: solo podrá consultar el inventario
        User::create([
            'name' => 'Empleado',
            'email' => 'empleado@inventario.test',
            'password' => Hash::make('password'),
            'role' => 'employee',
        ]);
    }
}
