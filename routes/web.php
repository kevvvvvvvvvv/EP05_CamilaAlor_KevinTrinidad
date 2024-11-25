<?php

use App\Models\Cliente;
use App\Http\Controllers\DataBaseController;
use App\Http\Controllers\AlmacenajeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ClientePedidoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ExhibicionController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotaHorarioController;
use App\Http\Controllers\ReporteVentaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasteleriaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PromocionController;
use App\Http\Controllers\ReporteCaducadoController;
use App\Http\Controllers\ReporteEmpleadoController;
use App\Http\Controllers\ReportePedidoController;
use App\Http\Controllers\ReporteProductoController;
use App\Http\Controllers\VentaController;
use Illuminate\Container\Attributes\Database;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;

//Inicio de sesión con google
Route::get('login-google', function () {
    return Socialite::driver('google')->redirect();
})->name('login-google');
 
Route::get('google-callback', function () {
    $user_google = Socialite::driver('google')->user();

    $user = Cliente::updateOrCreate([
        'google_id'=>$user_google->id,
    ],[
        'alias'=>$user_google->name,
        'email'=>$user_google->email,
        'profile_image' => $user_google->avatar
    ]);

    Auth::guard('cliente')->login($user);
    return redirect('/');
});

//Pagina donde se mostrarán los productos
Route::get('/',[ExhibicionController::class,'dashboard'])->name('principal');
Route::get('/pasteles',[ExhibicionController::class,'showPasteles'])->name('principal.pasteles');
Route::get('/productos',[ExhibicionController::class,'showProductos'])->name('principal.productos');
Route::get('/personalizados',[ExhibicionController::class,'showPersonalizados'])->name('principal.personalizados');


//Rutas para producto
Route::get('producto/create',[ProductoController::class,'create'])
    ->middleware(['auth:empleado','can:crear producto'])
    ->name('producto.create');
Route::post('producto',[ProductoController::class,'store'])->name('producto.store');

Route::get('producto/{id}/edit',[ProductoController::class,'edit'])
    ->middleware(['auth:empleado','can:editar producto'])
    ->name('producto.edit');
Route::put('producto/{id}',[ProductoController::class,'update'])->name('producto.update');


Route::delete('producto/{id}', [ProductoController::class, 'destroy'])
    ->middleware(['auth:empleado','can:eliminar producto'])
    ->name('producto.destroy');

Route::get('consultar-producto', [ProductoController::class, 'consultarProducto'])
    ->middleware(['auth:empleado', 'can:consultar producto'])
    ->name('consultar-producto');


//Rutas para almacenaje
Route::get('almacenaje/create',[AlmacenajeController::class,'create'])
    ->middleware(['auth:empleado','can:crear almacenaje'])
    ->name('almacenaje.create');
Route::post('almacenaje',[AlmacenajeController::class,'store'])->name('almacenaje.store');

Route::get('almacenaje/{id}/edit',[AlmacenajeController::class,'edit'])
    ->middleware(['auth:empleado','can:editar almacenaje'])
    ->name('almacenaje.edit');
Route::put('almacenaje/{id}',[AlmacenajeController::class,'update'])->name('almacenaje.update');

Route::delete('almacenaje/{id}', [AlmacenajeController::class, 'destroy'])
    ->middleware(['auth:empleado','can:eliminar almacenaje'])
    ->name('almacenaje.destroy');

Route::get('consultar-almacenaje', [AlmacenajeController::class, 'consultarAlmacenaje'])
    ->middleware(['auth:empleado','can:consultar almacenaje'])
    ->name('consultar-almacenaje');


//Rutas para horario
Route::get('horario/create',[HorarioController::class,'create'])
    ->middleware(['auth:empleado','can:crear horario'])
    ->name('horario.create');
Route::post('horario',[HorarioController::class,'store'])->name('horario.store');

Route::get('horario/{id}/edit',[HorarioController::class,'edit'])
    ->middleware(['auth:empleado','can:editar horario'])
    ->name('horario.edit');
Route::put('horario/{id}',[HorarioController::class,'update'])->name('horario.update');


Route::delete('horario/{id}', [HorarioController::class, 'destroy'])
    ->middleware(['auth:empleado','can:eliminar horario'])
    ->name('horario.destroy');

Route::get('consultar-horario', [HorarioController::class, 'consultarHorario'])
    ->middleware(['auth:empleado','can:consultar horario'])
    ->name('consultar-horario');

//Rutas para asignar horario
Route::get('asign/create', [NotaHorarioController::class, 'asign'])
    ->middleware(['auth:empleado','can:consultar horario'])
    ->name('horario.asign');
Route::post('asign', [NotaHorarioController::class, 'asignStore'])->name('horario.asign.store');

Route::get('asign/{id}/edit',[NotaHorarioController::class,'edit'])
    ->middleware(['auth:empleado','can:editar horario'])
    ->name('asign.edit');
Route::put('asign/{id}',[NotaHorarioController::class,'update'])->name('asign.update');

Route::delete('asign/{id}', [NotaHorarioController::class, 'destroy'])
    ->middleware(['auth:empleado','can:eliminar horario'])
    ->name('asign.destroy');

Route::get('consultar-asign', [NotaHorarioController::class, 'asignShow'])
    ->middleware(['auth:empleado','can:consultar horario'])
    ->name('horario.asign.show');

Route::get('consultar-asign-empleado',[NotaHorarioController::class, 'asignEmpleadoShow'])
    ->middleware(['auth:empleado','can:consultar horario'])
    ->name('horario.asign.empleado.show');


//Rutas para promocion
Route::get('promocion/create',[PromocionController::class,'create'])
    ->middleware(['auth:empleado','can:crear promocion'])
    ->name('promocion.create');
Route::post('promocion',[PromocionController::class,'store'])->name('promocion.store');

Route::get('promocion/{id}/edit',[PromocionController::class,'edit'])
    ->middleware(['auth:empleado','can:editar promocion'])
    ->name('promocion.edit');
Route::put('promocion/{id}',[PromocionController::class,'update'])->name('promocion.update');

Route::delete('promocion/{id}', [PromocionController::class, 'destroy'])
    ->middleware(['auth:empleado','can:eliminar promocion'])
    ->name('promocion.destroy');

Route::get('consultar-promocion', [PromocionController::class, 'consultarPromocion'])
    ->middleware(['auth:empleado','can:consultar promocion'])
    ->name('consultar-promocion');


//Rutas para cliente
Route::get('cliente/create',[ClienteController::class,'create'])
    ->middleware(['auth:empleado','can:crear cliente'])
    ->name('cliente.create');
Route::post('cliente',[ClienteController::class,'store'])->name('cliente.store');

Route::get('cliente/{id}/edit',[ClienteController::class,'edit'])
    ->middleware(['auth:empleado','can:editar cliente'])
    ->name('cliente.edit');
Route::put('cliente/{id}',[ClienteController::class,'update'])->name('cliente.update');

Route::delete('cliente/{id}', [ClienteController::class, 'destroy'])
    ->middleware(['auth:empleado','can:eliminar cliente'])
    ->name('cliente.destroy');

Route::get('consultar-cliente', [ClienteController::class, 'consultarCliente'])
    ->middleware(['auth:empleado','can:consultar cliente'])
    ->name('consultar-cliente');


//Rutas para empleado
Route::get('empleado/create',[EmpleadoController::class,'create'])
    ->middleware(['auth:empleado','can:crear empleado'])
    ->name('empleado.create');
Route::post('empleado',[EmpleadoController::class,'store'])->name('empleado.store');

Route::get('empleado/{id}/edit',[EmpleadoController::class,'edit'])
    ->middleware(['auth:empleado','can:editar empleado'])
    ->name('empleado.edit');
Route::put('empleado/{id}',[EmpleadoController::class,'update'])->name('empleado.update');


Route::delete('empleado/{id}', [EmpleadoController::class, 'destroy'])
    ->middleware(['auth:empleado','can:eliminar empleado'])
    ->name('empleado.destroy');

Route::get('consultar-empleado', [EmpleadoController::class, 'consultarEmpleado'])
    ->middleware(['auth:empleado','can:consultar empleado'])
    ->name('consultar-empleado');


//rutas para pedido
Route::get('pedido/create',[PedidoController::class,'create'])
    ->middleware(['auth:empleado','can:crear pedido'])
    ->name('pedido.create');
    
Route::post('pedido',[PedidoController::class,'store'])->name('pedido.store');


Route::get('pedido/{id}/edit',[PedidoController::class,'edit'])
    ->middleware(['auth:empleado','can:editar pedido'])
    ->name('pedido.edit');
Route::put('pedido/{id}',[PedidoController::class,'update'])->name('pedido.update');


Route::delete('pedido/{id}', [PedidoController::class, 'destroy'])
    ->middleware(['auth:empleado','can:eliminar pedido'])
    ->name('pedido.destroy');


Route::get('consultar-pedido', [PedidoController::class, 'consultarPedido'])
    ->middleware(['auth:empleado','can:consultar pedido'])
    ->name('consultar-pedido');


//Rutas para venta
Route::get('consultar-venta',[VentaController::class,'consultarVenta'])
    ->middleware(['auth:empleado','can:consultar venta'])
    ->name('consultar-venta');

Route::get('venta/{id}/edit',[VentaController::class,'edit'])
    ->middleware(['auth:empleado','can:editar venta'])
    ->name('venta.edit');
Route::put('venta/{id}',[VentaController::class,'update'])->name('venta.update');


Route::delete('venta/{id}', [VentaController::class, 'destroy'])
    ->middleware(['auth:empleado','can:eliminar venta'])
    ->name('venta.destroy');   


Route::get('consultar-venta/pedido/{id}',[VentaController::class,'consultarDetalle'])
    ->middleware(['auth:empleado','can:consultar venta'])
    ->name('consultar-venta.pedido');


//Páginas para la validación de los datos insertados
Route::post('validar-registro',[LoginController::class,'validarRegistro'])->name('validar-registro');


//Página para la el inicio de sesión
Route::get('login',[LoginController::class,'login'])->name('login');
Route::post('validar-sesion',[LoginController::class,'validarSesion'])->name('validar-sesion');

//Página para registrarse
Route::get('signup',[LoginController::class,'signup'])->name('signup');
Route::post('logout',[LoginController::class,'logout'])->name('logout');


//Rutas para los reportes
Route::get('reportes', [ReporteVentaController::class,'show'])
    ->middleware(['auth:empleado','can:reporte'])
    ->name('reportes.dashboard');

    //Rutas para reportes de ventas
    Route::get('reportes/ventas', [ReporteVentaController::class,'showVentas'])
        ->middleware(['auth:empleado','can:reporte'])
        ->name('reportes.ventas');

    Route::post('reportes/ventas-generar', [ReporteVentaController::class,'showVentasReporte'])->name('ventas.generar');

    Route::get('reportes/ventas/diarias/pdf', [ReporteVentaController::class, 'generarDiarioPDF'])
        ->middleware(['auth:empleado', 'can:reporte'])
        ->name('reportes.ventasdiarias.pdf');

    Route::post('reportes/ventas/semanales/pdf', [ReporteVentaController::class, 'generarSemanalPDF'])
    ->middleware(['auth:empleado', 'can:reporte'])
    ->name('reportes.ventassemanales.pdf');

    Route::post('reportes/ventas/mensuales/pdf', [ReporteVentaController::class, 'generarMensualPDF'])
    ->middleware(['auth:empleado', 'can:reporte'])
    ->name('reportes.ventasmensuales.pdf');

    //Rutas para reportes de productos
    Route::get('reportes/productos', [ReporteProductoController::class,'showProductos'])
        ->middleware(['auth:empleado','can:reporte'])
        ->name('reportes.productos');

    Route::post('reportes/productos-generar', [ReporteProductoController::class,'showProductosReporte'])->name('productos.generar');

    Route::post('reportes/productos/semanales/pdf', [ReporteProductoController::class, 'generarSemanalPDF'])
    ->middleware(['auth:empleado', 'can:reporte'])
    ->name('reportes.productossemanales.pdf');

    Route::post('reportes/productos/mensuales/pdf', [ReporteProductoController::class, 'generarMensualPDF'])
    ->middleware(['auth:empleado', 'can:reporte'])
    ->name('reportes.productosmensuales.pdf');

    //Rutas para reporte de empleados
    Route::get('reportes/empleados', [ReporteEmpleadoController::class,'showEmpleados'])
        ->middleware(['auth:empleado','can:reporte'])
        ->name('reportes.empleados');

    Route::post('reportes/empleados-generar', [ReporteEmpleadoController::class,'showEmpleadosReporte'])->name('empleados.generar');    

    Route::post('reportes/empleados/mensuales/pdf', [ReporteEmpleadoController::class, 'generarMensualPDF'])
    ->middleware(['auth:empleado', 'can:reporte'])
    ->name('reportes.empleadosmensuales.pdf');

    //Rutas para reporte de productos del almacenaje próximos a caducar
    Route::get('reportes/caducados', [ReporteCaducadoController::class,'showCaducados'])
        ->middleware(['auth:empleado','can:reporte'])
        ->name('reportes.caducados');

    Route::get('reportes/caducados/pdf', [ReporteCaducadoController::class, 'generarCaducadosPDF'])
        ->middleware(['auth:empleado', 'can:reporte'])
        ->name('reportes.caducados.pdf');

    //Rutas para reporte de pedidos próximos a entregar
    Route::get('reportes/pedidos', [ReportePedidoController::class,'showPedidos'])
        ->middleware(['auth:empleado','can:reporte'])
        ->name('reportes.pedidos');

    Route::get('reportes/pedidos/pdf', [ReportePedidoController::class, 'generarPedidosPDF'])
        ->middleware(['auth:empleado', 'can:reporte'])
        ->name('reportes.pedidos.pdf');


//Rutas para la exportación y restauración de la base de datos

Route::get('base-de-datos', [DataBaseController::class,'show'])
    ->middleware(['auth:empleado','can:db'])
    ->name('db.dashboard');


    Route::get('base-de-dato/exportar',[DataBaseController::class,'exportarDatabase'])
    ->name('exportar.database');

    Route::post('/restore-database', [DataBaseController::class, 'restaurarDatabase'])
    ->name('database.restore');


/*--------------------------------------------------------------> Rutas para clientes */

//Editar perfil
Route::get('cliente/edit', [ClienteController::class, 'editSelf'])
    ->middleware('auth:cliente')
    ->name('cliente.edit.self');


//Generar un pedido
Route::get('pedido/cliente/create',[ClientePedidoController::class,'create'])
    ->middleware('auth:cliente')
    ->name('pedido.cliente.create');
Route::post('pedido/cliente',[ClientePedidoController::class,'store'])->name('pedido.cliente.store');

Route::get('consultar-venta/cliente',[ClientePedidoController::class,'consultarVenta'])
    ->middleware('auth:cliente')
    ->name('consultar-venta.cliente');

Route::get('consultar-venta/{id}',[ClientePedidoController::class,'consultarPedido'])
    ->middleware('auth:cliente')
    ->name('consultar-pedido.cliente');

Route::patch('pedido/cliente/{id}',[ClientePedidoController::class,'update'])
    ->name('pedido.cliente');