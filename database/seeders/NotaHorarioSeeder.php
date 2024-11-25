<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NotaHorario;

class NotaHorarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notaHorario = new NotaHorario();
        $notaHorario -> idh = 1;
        $notaHorario -> ide = 1;
        $notaHorario -> save();

        $notaHorario = new NotaHorario();
        $notaHorario -> idh = 3;
        $notaHorario -> ide = 1;
        $notaHorario -> save();

        $notaHorario = new NotaHorario();
        $notaHorario -> idh = 2;
        $notaHorario -> ide = 2;
        $notaHorario -> save();
    }
}
