<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Productos de pastelería

        $producto = new Producto();
        $producto->idpro = 1;
        $producto->nombre = 'Pastel Moka';
        $producto->tipo = 'Pastelería';
        $producto->descripcion = 'Pan de chocolate bañado en tres leches de moka con crema de café.';
        $producto->precio = 150.00;
        $producto->imagen = 'img/pastel_moka.png';
        $producto->save();
    
        $producto = new Producto();
        $producto->idpro = 2;
        $producto->nombre = 'Pastel Oreo (Chocolate o Vainilla)';
        $producto->tipo = 'Pastelería';
        $producto->descripcion = 'Pan de chocolate o vainilla bañado en tres leches con relleno de galleta oreo.';
        $producto->precio = 30.00;
        $producto->imagen = 'img/pastel_oreo.png';
        $producto->save();
    
        $producto = new Producto();
        $producto->idpro = 3;
        $producto->nombre = 'Pastel Combinado';
        $producto->tipo = 'Pastelería';
        $producto->descripcion = 'Pan de chocolate con pan de vainilla bañado en tres leches.';
        $producto->precio = 25.00;
        $producto->imagen = 'img/pastel_combinado.png';
        $producto->save();
    
        $producto = new Producto();
        $producto->idpro = 4;
        $producto->nombre = 'Pastel de Queso con Zarzamora';
        $producto->tipo = 'Pastelería';
        $producto->descripcion = 'Pastel de queso Philadelphia con mermelada de zarzamora.';
        $producto->precio = 180.00;
        $producto->imagen = 'img/pastel_zarzamora.png';
        $producto->save();

        $producto = new Producto();
        $producto->idpro = 5;
        $producto->nombre = 'Pastel Kalhua';
        $producto->tipo = 'Pastelería';
        $producto->descripcion = 'Pastel de vainilla bañado en tres leches de ron con kalhua y crema de café.';
        $producto->precio = 180.00;
        $producto->imagen = 'img/pastel_kalhua.png';
        $producto->save();

        $producto = new Producto();
        $producto->idpro = 6;
        $producto->nombre = 'Pastel de Durazno';
        $producto->tipo = 'Pastelería';
        $producto->descripcion = 'Pastel de vainilla bañado en tres leches relleno de durazno almíbar.';
        $producto->precio = 180.00;
        $producto->imagen = 'img/pastel_durazno.png';
        $producto->save();

        $producto = new Producto();
        $producto->idpro = 7;
        $producto->nombre = 'Pastel de Chispas';
        $producto->tipo = 'Pastelería';
        $producto->descripcion = 'Pastel de vainilla bañado en tres leches relleno de chispas de chocolate.';
        $producto->precio = 180.00;
        $producto->imagen = 'img/pastel_chispas.png';
        $producto->save();

        $producto = new Producto();
        $producto->idpro = 8;
        $producto->nombre = 'Torta Napolitana';
        $producto->tipo = 'Pastelería';
        $producto->descripcion = 'Pastel de vainilla bañado en tres leches con relleno de flan napolitano.';
        $producto->precio = 180.00;
        $producto->imagen = 'img/pastel_flan.png';
        $producto->save();


        // Productos de la cafetería
        $producto = new Producto();
        $producto->idpro = 9;
        $producto->nombre = 'Café Americano';
        $producto->tipo = 'Cafetería';
        $producto->descripcion = 'Café americano clásico hecho con granos 100% arábica.';
        $producto->precio = 25.00;
        $producto->imagen = null;
        $producto->save();

        $producto = new Producto();
        $producto->idpro = 10;
        $producto->nombre = 'Latte de Caramelo';
        $producto->tipo = 'Cafetería';
        $producto->descripcion = 'Café espresso con leche vaporizada y caramelo.';
        $producto->precio = 40.00;
        $producto->imagen = null;
        $producto->save();

        $producto = new Producto();
        $producto->idpro = 11;
        $producto->nombre = 'Té Chai Latte';
        $producto->tipo = 'Cafetería';
        $producto->descripcion = 'Mezcla de té chai con leche vaporizada y especias.';
        $producto->precio = 35.00;
        $producto->imagen = null;
        $producto->save();

    }
}
