<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'guard_name'];

    // Relación muchos a muchos con Permission
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }

    // Relación uno a muchos inversa con Empleado
    public function empleados()
    {
        return $this->hasMany(Empleado::class);
    }
}
