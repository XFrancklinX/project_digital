<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    protected $table = 'unidades';

    protected $fillable = [
        'descrip',
        'estado',
        'created_at',
        'updated_at'
    ];
}
