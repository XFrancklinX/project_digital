<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $table = 'institucions';

    protected $fillable = [
        'descrip',
        'ciudad',
        'estado',
        'created_at',
        'updated_at'
    ];
}
