<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacenaje extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="almacenaje";
    protected $primaryKey = 'idalm';
}
