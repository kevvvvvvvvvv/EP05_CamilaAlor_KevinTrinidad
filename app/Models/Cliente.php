<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\Access\Authorizable;


class Cliente extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    use Authorizable;
    public $timestamps = false;
    protected $table="cliente";
    protected $primaryKey = 'idcli';

    protected $guard_name = 'web';
    
    //columnas que quieres usar para la autenticación
    protected $fillable = ['email','alias','contrasena','google_id','profile_image','nombre'];

    // campos que se usarán como contraseña
    protected $hidden = ['contrasena'];
    protected $authPasswordName = 'contrasena';

    //Esto se utiliza para recuperar la contraseña
    public function getAuthPassword()
    {
        return $this->contrasena;
    }
}
