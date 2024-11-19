<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';

    protected $fillable = [
        'grado',
        'apell_pat',
        'apell_mat',
        'nombres',
        'direccion',
        'telefono',
        'estado',
        'unidades_id',
        'cargos_id',
        'created_at',
        'updated_at'
    ];
}
