<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Promocion;

class PromocionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promocion1 = new Promocion();
        $promocion1->idprom = 1;
        $promocion1->codigo = 'PROMO10';
        $promocion1->descuento = 0.10;
        $promocion1->dias = 7;
        $promocion1->descripcion = '10% de descuento en productos seleccionados';
        $promocion1->estatus = 'Activa';
        $promocion1->save();

        $promocion2 = new Promocion();
        $promocion2->idprom = 2;
        $promocion2->codigo = 'PROMO20';
        $promocion2->descuento = 0.20;
        $promocion2->dias = 14;
        $promocion2->descripcion = '20% de descuento en tu primera compra';
        $promocion2->estatus = 'Activa';
        $promocion2->save();

        $promocion3 = new Promocion();
        $promocion3->idprom = 3;
        $promocion3->codigo = 'PROMO5';
        $promocion3->descuento = 0.5;
        $promocion3->dias = 5;
        $promocion3->descripcion = '5% de descuento en productos de pastelería';
        $promocion3->estatus = 'Inactiva';
        $promocion3->save();
    }
}
