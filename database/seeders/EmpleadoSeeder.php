<?php

namespace Database\Seeders;

use App\Models\Empleado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $empleado = new Empleado();
        $empleado -> nombre = "Kevin";
        $empleado -> ap = "Trinidad";
        $empleado -> am = "Medina";
        $empleado -> genero = 2;
        $empleado -> fenac = "2004-02-11";
        $empleado -> feIng = "2022-01-04";
        $empleado -> direccion = "Tejalpa";
        $empleado -> telefono = "7774571517";
        $empleado -> email = "kevinyahirt@gmail.com";
        $empleado -> contrasena = Hash::make('123456');
        $empleado -> profile_image= "https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcT0GjmhUuqjA7qN8Vm7mENIjZOlx-pEtHOHYaxaeBX4BripJovU";
        $empleado -> assignRole(roles:'administrador');
        $empleado -> save();

        $empleado = new Empleado();
        $empleado -> nombre = "Camila";
        $empleado -> ap = "Alor";
        $empleado -> am = "Contreras";
        $empleado -> genero = 1;
        $empleado -> fenac = "2004-01-30";
        $empleado -> feIng = "2024-10-22";
        $empleado -> direccion = "Emiliano Zapata";
        $empleado -> telefono = "7774081082";
        $empleado -> email = "acco220170@upemor.edu.mx";
        $empleado -> contrasena = Hash::make('123456');
        $empleado -> assignRole(roles:'empleado');
        $empleado -> profile_image="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRCAJH4R87uV3Rvncs3L3urjeNESAfJGTMTrA&s";
        $empleado -> save();

    }
}
