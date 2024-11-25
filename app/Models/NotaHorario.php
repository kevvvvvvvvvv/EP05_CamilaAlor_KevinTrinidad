<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaHorario extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="nota_horario";
    protected $primaryKey = 'idNotaHo';
}
