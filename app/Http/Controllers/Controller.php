<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function correspondencia(){
        return view('correspondencia.index');
    }
}
