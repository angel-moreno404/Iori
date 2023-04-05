<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_sala',
        'admin_sala',
        
    ];
}
