<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Horario;

class HorarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $horario = new Horario();
        $horario -> dia = "Lunes";
        $horario -> horaentrada = "08:00:00";
        $horario -> horasalida = "14:00:00";
        $horario -> save();

        $horario = new Horario();
        $horario -> dia = "Miércoles";
        $horario -> horaentrada = "09:00:00";
        $horario -> horasalida = "18:00:00";
        $horario -> save();

        $horario = new Horario();
        $horario -> dia = "Viernes";
        $horario -> horaentrada = "13:00:00";
        $horario -> horasalida = "20:00:00";
        $horario -> save();
    }
}
