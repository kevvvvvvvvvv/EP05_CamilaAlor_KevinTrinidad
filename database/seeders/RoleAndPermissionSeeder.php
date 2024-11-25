<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Diferentes roles
        $roleAdministrador=Role::firstOrCreate([
            'name'=>'administrador',
        ]);

        $roleEmpleado=Role::firstOrCreate([
            'name'=>'empleado',
        ]);

        $roleCliente=Role::firstOrCreate([
            'name'=>'cliente',
        ]);

        $permissions = [
            // Permisos para clientes
            ['name' => 'actualizar cliente'],
            ['name' => 'solicitar venta'],
        
            // Permisos para empleados
            ['name' => 'crear pedido'],
            ['name' => 'eliminar pedido'],
            ['name' => 'consultar pedido'],
            ['name' => 'editar pedido'],
        
            ['name' => 'crear almacenaje'],
            ['name' => 'eliminar almacenaje'],
            ['name' => 'consultar almacenaje'],
            ['name' => 'editar almacenaje'],
        
            ['name' => 'crear cliente'],
            ['name' => 'consultar cliente'],
            ['name' => 'consultar horario'],
            ['name' => 'consultar producto'],
            ['name' => 'consultar promocion'],

            ['name' => 'eliminar venta'],
            ['name' => 'consultar venta'],
            ['name' => 'editar venta'],
        
            // Permisos para administradores
            ['name' => 'crear empleado'],
            ['name' => 'eliminar empleado'],
            ['name' => 'consultar empleado'],
            ['name' => 'editar empleado'],
        
            ['name' => 'crear cliente'],
            ['name' => 'eliminar cliente'],
            ['name' => 'consultar cliente'],
            ['name' => 'editar cliente'],
        
            ['name' => 'crear producto'],
            ['name' => 'eliminar producto'],
            ['name' => 'consultar producto'],
            ['name' => 'editar producto'],
        
            ['name' => 'crear horario'],
            ['name' => 'eliminar horario'],
            ['name' => 'consultar horario'],
            ['name' => 'editar horario'],
        
            ['name' => 'crear promocion'],
            ['name' => 'eliminar promocion'],
            ['name' => 'consultar promocion'],
            ['name' => 'editar promocion'],

            ['name' => 'crear pedido'],
            ['name' => 'eliminar pedido'],
            ['name' => 'consultar pedido'],
            ['name' => 'editar pedido'],

            ['name' => 'eliminar venta'],
            ['name' => 'consultar venta'],
            ['name' => 'editar venta'],

            ['name' => 'reporte'],
            ['name' => 'db'],
        ];
        
        foreach ($permissions as $permission) {
            Permission::firstOrCreate($permission);
        }
        
        // Roles para los clientes
        $roleCliente->givePermissionTo(
            'actualizar cliente',
            'solicitar venta'
        );
        
        // Roles para los empleados
        $roleEmpleado->givePermissionTo(
            'crear pedido',
            'eliminar pedido',
            'consultar pedido',
            'editar pedido',
            
            'crear almacenaje',
            'eliminar almacenaje',
            'consultar almacenaje',
            'editar almacenaje',
            
            'crear cliente',
            'consultar cliente',
            'consultar horario',
            'consultar producto',
            'consultar promocion',

            'eliminar venta',
            'consultar venta',
            'editar venta',            
        );
        
        // Roles para los administradores
        $roleAdministrador->givePermissionTo(
            'crear empleado',
            'eliminar empleado',
            'consultar empleado',
            'editar empleado',
        
            'crear cliente',
            'eliminar cliente',
            'consultar cliente',
            'editar cliente',
        
            'crear producto',
            'eliminar producto',
            'consultar producto',
            'editar producto',

            'crear almacenaje',
            'eliminar almacenaje',
            'consultar almacenaje',
            'editar almacenaje',
        
            'crear horario',
            'eliminar horario',
            'consultar horario',
            'editar horario',
        
            'crear promocion',
            'eliminar promocion',
            'consultar promocion',
            'editar promocion',
            'reporte',

            'crear pedido',
            'eliminar pedido',
            'consultar pedido',
            'editar pedido',

            'eliminar venta',
            'consultar venta',
            'editar venta',

            'db',
        );
        
    }
}
