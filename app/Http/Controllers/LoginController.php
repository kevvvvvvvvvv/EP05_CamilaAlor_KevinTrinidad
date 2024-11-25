<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCliente;
use App\Http\Requests\StoreClienteByClient;
use App\Models\Empleado;
use App\Models\Cliente;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use App\Http\Requests\StoreLogin;
use App\Mail\Credenciales;
use Illuminate\Support\Facades\Mail;


class LoginController extends Controller
{
    use HasFactory, HasRoles; 

    /*
        Recibe: nada
        Retorna: vista para el registro
    */
    public function signup(){
        return view('signup');
    }

    /*
        Recibe: correo y contraseña
        Retorna: vista del login para iniciar sesión     
    */
    public function validarRegistro(StoreClienteByClient $request){
        $cliente = new Cliente();
        $cliente -> email = $request -> email;
        $cliente -> contrasena = Hash::make($request->contrasena);
        $cliente -> save();

        //Enviar correo con la contraseña
        $contrasena = $request->contrasena;
        Mail::to($cliente->email)->send(new Credenciales($cliente -> nombre , $contrasena));

        return redirect(route('login'));
    }

    /*
        Recibe: Nada
        Envía:vista para iniciar sesión
    */
    public function login(){
        return view('login');
    }

    /*
        Validar el inicio de sesión
        Recibe: Correo y contraseña
        Retorna:  si las credenciales son válidas retorna
                  a la vista principal con la autentificación 
                  correspondiente 
    
    */
    public function validarSesion(Request $request)
    {
        //validar las credenciales
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'contrasena' => ['required','string'],
        ],[
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo electrónico es inválido.',
            'contrasena.required' => 'El campo contraseña es obligatorio.',
        ]);

        $empleado = Empleado::where('email', $credentials['email'])->first();

        //Realizando el intento de autenticación
        if (Auth::guard('empleado')->attempt(['email' => $credentials['email'], 'password' => $credentials['contrasena']])){
            Auth::guard('empleado')->login($empleado);

            $request->session()->regenerate();
            return redirect()->intended('/')->with('user', Auth::guard('empleado')->user());
        }else{
            $cliente = Cliente::where('email', $credentials['email'])->first();
            if (Auth::guard('cliente')->attempt(['email' => $credentials['email'], 'password' => $credentials['contrasena']])){
                Auth::guard('cliente')->login($cliente);
                $request->session()->regenerate();
                return redirect()->intended('/')->with('user', Auth::guard('cliente')->user());
            }
            // Devolver error de autenticación
            return back()->withErrors(['usuario' => 'Las credenciales proporcionadas son incorrectas.'])->withInput();
        }
    }

    /*
        Recibe: nada
        Retorna: vista a la página principal
    */
    public function logout(Request $request)
    {
        Auth::guard('empleado')->logout();
    
        //Regenerar la sesión y redirigir al usuario
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/'); // Redirige a la página principal
    }
}
