<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cliente = new Cliente();
        $cliente->nombre = "Juan";
        $cliente->ap = "Pérez";
        $cliente->am = "López";
        $cliente->genero = "Masculino";
        $cliente->direccion = "Av. Revolución 123, Ciudad de México";
        $cliente->fenac = "1990-05-15";
        $cliente->telefono = "5551234567";
        $cliente->email = "juan.perez@example.com";
        $cliente->contrasena = Hash::make("password123");
        $cliente->save();

        $cliente = new Cliente();
        $cliente->nombre = "Ana";
        $cliente->ap = "García";
        $cliente->am = "Rodríguez";
        $cliente->genero = "Femenino";
        $cliente->direccion = "Calle Morelos 45, Guadalajara";
        $cliente->fenac = "1985-11-30";
        $cliente->telefono = "3337654321";
        $cliente->email = "ana.garcia@example.com";
        $cliente->contrasena = Hash::make("password456");
        $cliente->save();

        $cliente = new Cliente();
        $cliente -> nombre = "Luis";
        $cliente -> ap = "Hernandez";
        $cliente -> am = "Fuentes";
        $cliente -> email = "Luis@gmail.com";
        $cliente -> contrasena = Hash::make('1234');
        $cliente -> profile_image = "https://cdn.shopify.com/s/files/1/1414/2472/files/5-The_School_of_Athens__by_Raffaello_Sanzio_da_Urbino.jpg?v=1558424890";
        $cliente -> assignRole(roles:'cliente');
        $cliente -> save();

    }
}
