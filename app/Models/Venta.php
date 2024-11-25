<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="venta";
    protected $primaryKey = 'idv';

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'ide', 'ide');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class,'idcli','idcli');
    }
}
