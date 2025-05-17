<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Categoria;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //User::factory(10)->create();
        
        /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */

        Categoria::create(['nombre' => 'Alimentacion', 'tipo' => 'gasto']);
        Categoria::create(['nombre' => 'Transporte', 'tipo' => 'gasto']);
        Categoria::create(['nombre' => 'Salud', 'tipo' => 'gasto']);
        Categoria::create(['nombre' => 'Entretenimiento', 'tipo' => 'gasto']);
        Categoria::create(['nombre' => 'Sueldos', 'tipo' => 'ingreso']);
        Categoria::create(['nombre' => 'Otros', 'tipo' => 'gasto']);
        Categoria::create(['nombre' => 'Ahorros', 'tipo' => 'gasto']);
        Categoria::create(['nombre' => 'Otros Ingresos', 'tipo' => 'ingreso']);
        Categoria::create(['nombre' => 'Otros gastos', 'tipo' => 'gasto']);

    }
}
