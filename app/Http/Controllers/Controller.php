<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    public function correspondencia(){
        return view('correspondencia.index');
    }

    public function gestion(){
        return view('gestion.index');
    }
}
