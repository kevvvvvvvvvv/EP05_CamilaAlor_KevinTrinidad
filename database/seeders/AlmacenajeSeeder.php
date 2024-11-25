<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Almacenaje;

class AlmacenajeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Producto 1: Utensilio
        $producto = new Almacenaje();
        $producto->nombre = "Batidora Eléctrica";
        $producto->descripcion = "Batidora de mano para repostería";
        $producto->fechaIng = Carbon::now()->format('Y-m-d');
        $producto->fechaCad = null;
        $producto->cantidad = 5;
        $producto->categoria = "Utensilio";
        $producto->save();

        // Producto 2: Utensilio
        $producto = new Almacenaje();
        $producto->nombre = "Molde para Pastel";
        $producto->descripcion = "Molde redondo de silicona, 24 cm";
        $producto->fechaIng = Carbon::now()->format('Y-m-d');
        $producto->fechaCad = null;
        $producto->cantidad = 10;
        $producto->categoria = "Utensilio";
        $producto->save();

        // Producto 3: Comida
        $producto = new Almacenaje();
        $producto->nombre = "Pastel de Chocolate";
        $producto->descripcion = "Pastel relleno de chocolate amargo";
        $producto->fechaIng = "2024-11-05";
        $producto->fechaCad = "2024-11-11";
        $producto->cantidad = 3;
        $producto->categoria = "Comida";
        $producto->save();

        // Producto 4: Comida
        $producto = new Almacenaje();
        $producto->nombre = "Pan de Elote";
        $producto->descripcion = "Pan dulce a base de elote natural";
        $producto->fechaIng = "2024-11-06";
        $producto->fechaCad = "2024-11-12";
        $producto->cantidad = 8;
        $producto->categoria = "Comida";
        $producto->save();

        // Producto 5: Utensilio
        $producto = new Almacenaje();
        $producto->nombre = "Espátula de Cocina";
        $producto->descripcion = "Espátula de silicona resistente al calor";
        $producto->fechaIng = Carbon::now()->format('Y-m-d');
        $producto->fechaCad = null;
        $producto->cantidad = 15;
        $producto->categoria = "Utensilio";
        $producto->save();

        // Producto 6: Comida
        $producto = new Almacenaje();
        $producto->nombre = "Café Molido Premium";
        $producto->descripcion = "Café molido para espresso, paquete de 500g";
        $producto->fechaIng = Carbon::now()->format('Y-m-d');
        $producto->fechaCad = Carbon::now()->addMonths(6)->format('Y-m-d');
        $producto->cantidad = 20;
        $producto->categoria = "Comida";
        $producto->save();
    }
}
