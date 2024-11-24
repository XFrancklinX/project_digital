<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documentos';

    protected $fillable = [
        'id',
        'fecha_doc',
        'codigo',
        'identificador',
        'referencia',
        'tipo_doc',
        'cargo',
        'fecha_reg',
        'archivo',
        'gestion',
        'estado',
        'institucions_id',
        'unidades_id',
        'categorias_id',
        'personas_id',
        'users_id',
        'created_at',
        'updated_at',
    ];
}
