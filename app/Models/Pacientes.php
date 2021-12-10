<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'apellido',
        'cedula',
        'telefono',
        'telefono2',
        'correo',
        'sexo',
        'direccion',
        'tipo',
        'foto',
        'estado'

    ];
}
