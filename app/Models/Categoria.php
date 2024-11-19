<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias_doc';

    protected $fillable = [
        'id',
        'descrip',
        'sigla',
        'estado',
        'unidades_id',
        'created_at',
        'updated_at'
    ];
}
