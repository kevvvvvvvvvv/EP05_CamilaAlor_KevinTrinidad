<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="pedido";
    protected $primaryKey = 'idped';

    public function promocion()
    {
        return $this->belongsTo(Promocion::class,'idprom','idprom');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class,'idpro','idpro');
    }
}
