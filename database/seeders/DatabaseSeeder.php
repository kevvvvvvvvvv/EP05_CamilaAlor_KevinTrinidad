<?php

namespace Database\Seeders;

use App\Models\Almacenaje;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleAndPermissionSeeder::class,
            EmpleadoSeeder::class, 
            ProductoSeeder::class,
            PromocionSeeder::class,
            ClienteSeeder::class,
            VentaSeeder::class,
            PedidoSeeder::class,
            HorarioSeeder::class,
            AlmacenajeSeeder::class,
            NotaHorarioSeeder::class
        ]);
    }
}
