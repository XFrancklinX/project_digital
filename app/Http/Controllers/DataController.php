<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Categoria;
use App\Models\Documento;
use App\Models\Institucion;
use App\Models\Persona;
use App\Models\Unidad;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function perfil()
    {
        $user = Auth::user();
        return view('perfil.index', compact('user'));
    }

    //CREATE

    //SHOW
    public function reportes_data(Request $request)
    {
        
        // Obtener las fechas enviadas
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $unidad_id = $request->input('report_unidad_id');
        
        //dd($request->all(), $startDate, $endDate, DB::table('documentos')->whereBetween('fecha_reg', [$startDate, $endDate])->get());
        // Realizar la consulta en base de datos, dependiendo de tu lógica
        if ($unidad_id != 0) {
            $resultados = Documento::where('unidades_id', $unidad_id)->whereBetween('fecha_reg', [$startDate, $endDate])->get();
        }
        else {
            $resultados = Documento::whereBetween('fecha_reg', [$startDate, $endDate])->get();
        }

        // Retornar los resultados como respuesta JSON
        return response()->json(['data' => $resultados]);
    }

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
                'unidades_id' => $request->offunidades_id,
                'cargos_id' => $request->offcargos_id,
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

    public function gestion_personas_store(Request $request)
    {
        //dd($request->all());
        try {
            $request->validate([
                'nombres' => 'required',
                'apell_pat' => 'required',
                'apell_mat' => 'required',
                'telefono' => 'required',
                'direccion' => 'required',
                'unidades_id' => 'required',
                'cargos_id' => 'required',

            ]);

            Persona::create([
                'grado' => '0',
                'nombres' => $request->nombres,
                'apell_pat' => $request->apell_pat,
                'apell_mat' => $request->apell_mat,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'unidades_id' => $request->offunidades_id,
                'cargos_id' => $request->offcargos_id,
            ]);

            return redirect()->route('gestion');
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

    public function gestion_institucions_store(Request $request)
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
            return redirect()->route('gestion');
        } catch (ValidationException $e) {
            // Si hay errores de validación, capturarlos
            $errors = $e->errors();  // Esto contiene los errores de validación
            // Depurar o mostrar los errores
            dd($errors); // Mostrar los errores
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }

    public function gestion_categorias_store(Request $request)
    {
        //dd($request->all(), $request->descrip[0]);
        try {
            $request->validate([
                'descrip' => 'required',
                'sigla' => 'required',
                'unidades_id' => 'required',
            ]);

            for ($i = 0; $i < count($request->descrip); $i++) {
                Categoria::create([
                    'descrip' => $request->descrip[$i],
                    'sigla' => $request->sigla[$i],
                    'unidades_id' => $request->unidades_id,
                ]);
            }
            return redirect()->route('gestion');
        } catch (ValidationException $e) {
            // Si hay errores de validación, capturarlos
            $errors = $e->errors();  // Esto contiene los errores de validación
            // Depurar o mostrar los errores
            dd($errors); // Mostrar los errores
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }

    public function gestion_unidades_store(Request $request)
    {
        try {
            $request->validate([
                'descrip' => 'required',
            ]);

            Unidad::create([
                'descrip' => $request->descrip,
            ]);
            return redirect()->route('gestion');
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

    public function gestion_personas_update(Request $request)
    {
        //dd($request->all());
        try {
            $request->validate([
                'nombres' => 'required',
                'apell_pat' => 'required',
                'apell_mat' => 'required',
                'telefono' => 'required',
                'direccion' => 'required',
                'unidades_id' => 'required',
                'cargos_id' => 'required',

            ]);

            if ($request->unidades_id != 0) {
                $unidades_id = $request->unidades_id;
            } else {
                $unidades_id = null;
            }

            if ($request->cargos_id != 0) {
                $cargos_id = $request->cargos_id;
            } else {
                $cargos_id = null;
            }

            Persona::where('id', $request->id)->update([
                'grado' => '0',
                'nombres' => $request->nombres,
                'apell_pat' => $request->apell_pat,
                'apell_mat' => $request->apell_mat,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'unidades_id' => $unidades_id,
                'cargos_id' => $cargos_id,
            ]);

            return redirect()->route('gestion');
        } catch (ValidationException $e) {
            // Si hay errores de validación, capturarlos
            $errors = $e->errors();  // Esto contiene los errores de validación
            // Depurar o mostrar los errores
            dd($errors); // Mostrar los errores
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }
    public function gestion_unidades_update(Request $request)
    {
        //dd($request->all());
        try {
            $request->validate([
                'descrip' => 'required',
                'estado' => 'required',
            ]);

            Unidad::where('id', $request->id)->update([
                'descrip' => $request->descrip,
                'estado' => $request->estado,
            ]);
            return redirect()->route('gestion');
        } catch (ValidationException $e) {
            // Si hay errores de validación, capturarlos            
            $errors = $e->errors();  // Esto contiene los errores de validación
            // Depurar o mostrar los errores
            dd($errors); // Mostrar los errores
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }
    public function gestion_categorias_update(Request $request)
    {
        try {
            $request->validate([
                'descrip' => 'required',
                'sigla' => 'required',
                'unidades_id' => 'required',
            ]);

            Categoria::where('id', $request->id)->update([
                'descrip' => $request->descrip,
                'sigla' => $request->sigla,
                'unidades_id' => $request->unidades_id,
            ]);

            return redirect()->route('gestion');
        } catch (ValidationException $e) {
            // Si hay errores de validación, capturarlos
            $errors = $e->errors();  // Esto contiene los errores de validación
            // Depurar o mostrar los errores
            dd($errors); // Mostrar los errores
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }
    public function gestion_institucions_update(Request $request)
    {
        try {
            $request->validate([
                'descrip' => 'required',
                'ciudad' => 'required',
            ]);

            Institucion::where('id', $request->id)->update([
                'descrip' => $request->descrip,
                'ciudad' => $request->ciudad,
            ]);
            return redirect()->route('gestion');
        } catch (ValidationException $e) {
            // Si hay errores de validación, capturarlos
            $errors = $e->errors();  // Esto contiene los errores de validación
            // Depurar o mostrar los errores
            dd($errors); // Mostrar los errores
            return redirect()->back()->withInput()->withErrors($errors);
        }
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
    public function gestion_edit(Request $request)
    {
        //dd($request->all());

        if ($request->status == 1) {
            $personas = Persona::find($request->id);
            $unidades = Unidad::all();
            $cargos = Cargo::all();
            $status = 1;
            return response()->json([view('includes.edit-personas', compact('personas', 'unidades', 'cargos', 'status'))->render()]);
        }

        if ($request->status == 2) {
            $status = 2;
            $unidades = Unidad::find($request->id);
            return response()->json([view('includes.edit-unidades', compact('unidades', 'status'))->render()]);
        }

        if ($request->status == 3) {
            $status = 3;
            $categorias = Categoria::find($request->id);
            return response()->json([view('includes.edit-categorias', compact('categorias', 'status'))->render()]);
        }

        if ($request->status == 4) {
            $status = 4;
            $institucions = Institucion::find($request->id);
            return response()->json([view('includes.edit-institucions', compact('institucions', 'status'))->render()]);
        }
    }
}
