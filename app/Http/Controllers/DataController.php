<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Categoria;
use App\Models\Documento;
use App\Models\Institucion;
use App\Models\Persona;
use App\Models\Unidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;

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
    public function correspondencia_store(Request $request)
    {
        //dd($request->all(), $request->categorias_id);

        try {
            $request->validate([
                'fecha_reg' => 'required',
                'code' => 'required',
                'identificador' => 'required',
                'referencia' => 'required',
                'unidades_id' => 'required',
                'categorias_id' => 'required',
                'radioDocumento' => 'required',
                'personas_id' => 'required',
                'cargo' => 'required',
                'instituciones_id' => 'required',
                'file.*' => 'mimes:pdf,doc,docx|max:10240',
            ]);


            $cont = str_pad(Documento::where('unidades_id', $request->unidades_id)->count() + 1, 5, '0', STR_PAD_LEFT);
            $code = Categoria::find($request->categorias_id)->sigla . '_' . $cont . '_' . date('Y');

            if ($request->hasfile('file')) {
                $files = $request->file('file');
                $i = 1;
                $namefiles = '';
                foreach ($files as $file) {
                    $name = 'document_' . $code . '_' . $i . '.' . $file->guessExtension();
                    $namefiles .= $name . '/';
                    $file->move(public_path('documents/'), $name);
                    $i++;
                }
            }

            Documento::create([
                'fecha_doc' => date('Y-m-d'),
                'codigo' => $code,
                'identificador' => $request->identificador,
                'referencia' => $request->referencia,
                'tipo_doc' => $request->radioDocumento,
                'cargo' => $request->cargo,
                'fecha_reg' => $request->fecha_reg,
                'archivo' => $namefiles,
                'gestion' => date('Y'),
                'institucions_id' => $request->instituciones_id,
                'unidades_id' => $request->unidades_id,
                'categorias_id' => $request->categorias_id,
                'personas_id' => $request->personas_id,
                'users_id' => Auth::user()->id
            ]);


            return redirect()->route('correspondencia');
        } catch (ValidationException $e) {
            // Si hay errores de validación, capturarlos
            $errors = $e->errors();  // Esto contiene los errores de validación

            // Depurar o mostrar los errores
            dd($errors); // Mostrar los errores

            return redirect()->back()->withInput()->withErrors($errors);
        }
    }

    public function personas_store(Request $request)
    {
        //dd($request->all());
        try {
            $request->validate([
                'nombres' => 'required',
                'apell_pat' => 'required',
                'apell_mat' => 'required',
                'telefono' => 'required',
                'direccion' => 'required',
                'offunidades_id' => 'required',
                'offcargos_id' => 'required',

            ]);

            Persona::create([
                'grado' => '0',
                'nombres' => $request->nombres,
                'apell_pat' => $request->apell_pat,
                'apell_mat' => $request->apell_mat,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'offunidades_id' => $request->offunidades_id,
                'offcargos_id' => $request->offcargos_id,
            ]);

            return response()->json([
                'success' => true,
                'id' => Persona::max('id'),  // ID del nuevo usuario
                'nombres' => $request->nombres,
                'apell_pat' => $request->apell_pat,
                'apell_mat' => $request->apell_mat
            ]);
        } catch (ValidationException $e) {
            // Si hay errores de validación, capturarlos
            $errors = $e->errors();  // Esto contiene los errores de validación
            // Depurar o mostrar los errores
            dd($errors); // Mostrar los errores
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }

    public function institucions_store(Request $request)
    {
        try {
            $request->validate([
                'descrip' => 'required',
                'ciudad' => 'required',
            ]);

            Institucion::create([
                'descrip' => $request->descrip,
                'ciudad' => $request->ciudad,
            ]);
            return response()->json([
                'success' => true,
                'id' => Institucion::max('id'),  // ID del nuevo usuario
                'descrip' => $request->descrip,
                'ciudad' => $request->ciudad,
            ]);
        } catch (ValidationException $e) {
            // Si hay errores de validación, capturarlos
            $errors = $e->errors();  // Esto contiene los errores de validación
            // Depurar o mostrar los errores
            dd($errors); // Mostrar los errores
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }

    //EDIT
    public function correspondencia_edit($id)
    {
        $documentos = Documento::find($id);
        return response()->json([view('correspondencia.edit', compact('documentos'))->render()]);
    }

    //UPDATE
    public function correspondencia_update(Request $request)
    {
        try {
            $request->validate([
                'fecha_reg' => 'required',
                'code' => 'required',
                'identificador' => 'required',
                'referencia' => 'required',
                'unidades_id' => 'required',
                'categorias_id' => 'required',
                'radioDocumento' => 'required',
                'personas_id' => 'required',
                'cargo' => 'required',
                'instituciones_id' => 'required',
                'file.*' => 'mimes:pdf,doc,docx|max:10240',
            ]);


            $explode = explode('/', $request->code);
            $code = Categoria::find($request->categorias_id)->sigla . '_' . $explode[1] . '_' . date('Y');

            $namefiles = '';
            if ($request->hasfile('file')) {
                $files = $request->file('file');
                $i = 1;
                foreach ($files as $file) {
                    $name = 'document_' . $code . '_' . $i . '.' . $file->guessExtension();
                    if (file_exists(public_path('documents/' . $name))) {
                        File::delete(public_path('documents/' . $name));

                        $namefiles .= $name . '/';
                        $file->move(public_path('documents/'), $name);
                        $i++;
                    } else {
                        $namefiles .= $name . '/';
                        $file->move(public_path('documents/'), $name);
                        $i++;
                    }
                }
            }
            //dd($namefiles, $request->id);

            Documento::where('id', $request->id)->update([
                'fecha_doc' => date('Y-m-d'),
                'codigo' => $code,
                'identificador' => $request->identificador,
                'referencia' => $request->referencia,
                'tipo_doc' => $request->radioDocumento,
                'cargo' => $request->cargo,
                'fecha_reg' => $request->fecha_reg,
                'archivo' => $namefiles,
                'gestion' => date('Y'),
                'institucions_id' => $request->instituciones_id,
                'unidades_id' => $request->unidades_id,
                'categorias_id' => $request->categorias_id,
                'personas_id' => $request->personas_id,
                'users_id' => Auth::user()->id
            ]);


            return redirect()->route('correspondencia');
        } catch (ValidationException $e) {
            // Si hay errores de validación, capturarlos
            $errors = $e->errors();  // Esto contiene los errores de validación

            // Depurar o mostrar los errores
            dd($errors); // Mostrar los errores

            return redirect()->back()->withInput()->withErrors($errors);
        }
    }

    public function correspondencia_anule(Request $request)
    {
        Documento::where('id', $request->id)->update([
            'estado' => 'B',
        ]);
        return redirect()->route('correspondencia');
    }

    //DELETE

    //COMBOS
    public function getCategorias(Request $request)
    {
        if ($request->unidades_id != 0) {
            $categorias = Categoria::where('unidades_id', $request->unidades_id)->get();
            return response()->json($categorias);
        } else {
            return response()->json([]);
        }
    }

    //MODAL
}
