<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class DataController extends Controller
{
    //INDEX
    public function correspondencia()
    {
        return view('correspondencia.index');
    }

    public function gestion()
    {
        return view('gestion.index');
    }

    //CREATE

    //SHOW

    //STORE

    //EDIT

    //UPDATE

    //DELETE

    //COMBOS
    public function getCategorias(Request $request)
    {
        if ($request->unidades_id != 0) {
            $categorias = Categoria::where('unidades_id', $request->unidades_id)->get();
            return response()->json($categorias);
        }
        else{
            return response()->json([]);
        }
    }

    //MODAL
}
