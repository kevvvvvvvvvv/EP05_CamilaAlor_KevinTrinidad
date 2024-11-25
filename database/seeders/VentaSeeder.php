<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Venta;
use Carbon\Carbon;


class VentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $venta = new Venta();
        $venta->fechaVent = "2024-10-01";
        $venta->fecEntrega = "2024-10-02";
        $venta->total = 500.00;
        $venta->ide = 1;
        $venta->idcli = 2;
        $venta->save();

        $venta = new Venta();
        $venta->fechaVent = "2024-10-05";
        $venta->fecEntrega = "2024-10-06";
        $venta->total = 300.00;
        $venta->ide = 2;
        $venta->idcli = 2;
        $venta->save();

        $venta = new Venta();
        $venta->fechaVent = "2024-10-10";
        $venta->fecEntrega = "2024-10-11";
        $venta->total = 750.00;
        $venta->ide = 1;
        $venta->idcli = 1;
        $venta->save();

        $venta = new Venta();
        $venta->fechaVent = "2024-10-15";
        $venta->fecEntrega = Carbon::now()->format('Y-m-d');
        $venta->total = 450.00;
        $venta->ide = 2;
        $venta->idcli = 1;
        $venta->save();

        $venta = new Venta();
        $venta->fechaVent = "2024-10-20";
        $venta->fecEntrega = Carbon::now()->addDays(3)->format('Y-m-d');
        $venta->total = 600.00;
        $venta->ide = 2;
        $venta->idcli = 1;
        $venta->save();
    
        $venta = new Venta();
        $venta->fechaVent = "2024-10-05";
        $venta->fecEntrega = "2024-10-05";
        $venta->total = 65.00;
        $venta->ide = 1;
        $venta->idcli = 1; 
        $venta->save();

        $venta = new Venta();
        $venta->fechaVent = "2024-10-05";
        $venta->fecEntrega = "2024-10-05";
        $venta->total = 135.00; 
        $venta->ide = 2;
        $venta->idcli = 2; 
        $venta->save();
    }
}
