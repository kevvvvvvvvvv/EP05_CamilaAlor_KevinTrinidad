<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCliente;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\Credenciales;
use Illuminate\Support\Facades\Mail;

class ClienteController extends Controller
{
    public function __construct()
    {

    }

    /*
        Vista para crear a un nuevo cliente
        Recibe: nada
        Retorna: vista para crear al cliente
    */
    public function create(){
        return view('cliente/create');
    }

    /*
        Registra a un cliente
        Recibe: 
            nombre(nombre)
            apellido paterno (ap)
            apellido materno (am)
            genero (genero)
            direccion (direccion)
            fecha de nacimiento (fenac)
            teléfono (telefono)
            correo electrónico (email)
            contraseña (contrasena)
            imagen de perfil (profile_image)
        Retorna: vista principal
    */
    
    public function store(StoreCliente $request){
        $cliente = new Cliente();
        $cliente -> nombre = $request -> nombre;
        $cliente -> ap = $request -> ap;
        $cliente -> am = $request -> am;
        $cliente -> genero = $request -> genero;
        $cliente -> direccion = $request -> direccion;
        $cliente -> fenac = $request -> fenac;
        $cliente -> telefono = $request -> telefono;
        $cliente -> email = $request -> email;
        $cliente -> contrasena = Hash::make($request->contrasena);
        $cliente -> profile_image = $request -> profile_image;
        
        //Enviar correo con la contraseña
        $contrasena = $request->contrasena;
        Mail::to($cliente->email)->send(new Credenciales($cliente -> nombre , $contrasena));
        
        $cliente -> save();
        return redirect(route('principal'));
    }

    /*
        Consultar a todos los clientes
        Recibe: nada
        Retorna: vista para consultar todos los clientes
                 junto con la información de todos los clientes
    */
    public function consultarCliente(){
        $cliente= Cliente::all();
        return view('cliente/consultar-cliente',compact('cliente'));
    }

    /*
        Editar cliente
        Recibe: el ID del cliente
        Retorna: vista para editar a un registor en específico
                 junta con toda su información
    */
    public function edit($idcli){
        $cliente=Cliente::find($idcli); 
        return view('cliente/edit',compact('cliente'));
    }

    /*
        Actualiza un cliente
        Recibe: 
            nombre(nombre)
            apellido paterno (ap)
            apellido materno (am)
            genero (genero)
            direccion (direccion)
            fecha de nacimiento (fenac)
            teléfono (telefono)
            correo electrónico (email)
            contraseña (contrasena)
            imagen de perfil (profile_image)
        Retorna: vista principal
    */
    public function update(StoreCliente $request,$idcli){
        $cliente = Cliente::find($idcli);
        $cliente -> nombre = $request -> nombre;
        $cliente -> ap = $request -> ap;
        $cliente -> am = $request -> am;
        $cliente -> genero = $request -> genero;
        $cliente -> direccion = $request -> direccion;
        $cliente -> fenac = $request -> fenac;
        $cliente -> telefono = $request -> telefono;
        $cliente -> email = $request -> email;
        $cliente -> profile_image = $request -> profile_image;
        
        if (!empty($request->contrasena)) {
            $cliente->contrasena = Hash::make($request->contrasena);
            $contrasena = $request->contrasena;
            Mail::to($cliente->email)->send(new Credenciales($cliente -> nombre , $contrasena));
        }

        $cliente -> save();

        return redirect()->route('principal');
    }


    /*
        Eliminar a un cliente
        Recibe: ID del cliente
        Retorna: Mensaje de éxito o fallo a la página a la 
                 que se hizo la solicitud
    */
    public function destroy($idcli){
        $cliente = Cliente::find($idcli);
        if($cliente){
            $cliente->delete();
            return response()->json(['message' => 'Cliente eliminado con éxito']);
        }else{
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
    }

    /*
        Muestra la información del cliente autenticado
        Recibe: nada
        Retorna: vista para editar la información propia del cliente 
                 que ha iniciado sesión
    */
    public function editSelf()
    {
        $cliente = Auth::guard('cliente')->user();
        return view('cliente.edit', ['cliente' => $cliente]);
    }
}
