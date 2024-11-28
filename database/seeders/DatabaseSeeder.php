<?php

namespace Database\Seeders;

use App\Models\Cargo;
use App\Models\Categoria;
use App\Models\Gestion;
use App\Models\Institucion;
use App\Models\Persona;
use App\Models\Unidad;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $cargos = [
            ['descrip' => 'RECTOR', 'estado' => 'A'],
            ['descrip' => 'DIRECTOR ACADEMICO', 'estado' => 'A'],
            ['descrip' => 'DIRECTOR ADMINISTRATIVO', 'estado' => 'A'],
            ['descrip' => 'SECRETARIO(A)', 'estado' => 'A']
        ];

        $gestions = [
            ['anio' => '2024', 'estado' => 'A'],
        ];

        $institucions = [
            ['descrip' => 'INTITUCION 1', 'ciudad' => 'CIUDAD 1', 'estado' => 'A'],
        ];

        $unidades = [
            ['descrip' => 'RECTORADO', 'estado' => 'A'],
            ['descrip' => 'DIRECCION ACADEMICA', 'estado' => 'A'],
            ['descrip' => 'DIRECCION ADMINISTRATIVA', 'estado' => 'A'],
        ];

        $personas = [
            ['grado' => '0', 'apell_pat' => 'CAHUANA', 'apell_mat' => 'ARENAS', 'nombres' => 'FRANCKLIN', 'direccion' => 'SD', 'telefono' => '1234', 'estado' => 'A', 'unidades_id' => null,'cargos_id' => null],
            ['grado' => '0', 'apell_pat' => 'PEREZ', 'apell_mat' => 'PEREZ', 'nombres' => 'JUAN', 'direccion' => 'SD', 'telefono' => '1234', 'estado' => 'A', 'unidades_id' => 1,'cargos_id' => 1],
            ['grado' => '0', 'apell_pat' => 'CANO', 'apell_mat' => 'ROCA', 'nombres' => 'MARTHA', 'direccion' => 'SD', 'telefono' => '231', 'estado' => 'A', 'unidades_id' => 3,'cargos_id' => 3],
            ['grado' => '0', 'apell_pat' => 'LOPEZ', 'apell_mat' => 'CORO', 'nombres' => 'RENE', 'direccion' => 'SD', 'telefono' => '123', 'estado' => 'A', 'unidades_id' => 2,'cargos_id' => 2],
        ];

        $users = [
            ['email' => 'admin@gmail.com', 'password' => Hash::make('123'), 'personas_id' => 1, 'role' => 'A', 'image' => null],
            ['email' => 'rectorado@gmail.com', 'password' => Hash::make('123'), 'personas_id' => 2, 'role' => 'R', 'image' => null],
            ['email' => 'academica@gmail.com', 'password' => Hash::make('123'), 'personas_id' => 3, 'role' => 'C', 'image' => null],
            ['email' => 'administrativo@gmail.com', 'password' => Hash::make('123'), 'personas_id' => 4, 'role' => 'C', 'image' => null],
        ];

        $categorias_doc = [
            ['descrip' => 'RESOLUCIONES RECTORALES', 'sigla' => 'RR', 'estado' => 'A', 'unidades_id' => 1],
            ['descrip' => 'INSTRUCTIVOS DE RECTORADO', 'sigla' => 'IR', 'estado' => 'A', 'unidades_id' => 1],
            ['descrip' => 'CARTAS DE  RECTORADO', 'sigla' => 'CR', 'estado' => 'A', 'unidades_id' => 1],
            ['descrip' => 'INFORMES DE RECTORADO', 'sigla' => 'FR', 'estado' => 'A', 'unidades_id' => 1],
            ['descrip' => 'DIAPOSITIVAS RECTORADO', 'sigla' => 'DR', 'estado' => 'A', 'unidades_id' => 1],
            ['descrip' => 'RESOLUCIONES MINISTERIALES', 'sigla' => 'RM', 'estado' => 'A', 'unidades_id' => 1],
            ['descrip' => 'RESOLUCIONES SECRETARIALES', 'sigla' => 'RS', 'estado' => 'A', 'unidades_id' => 1],
            ['descrip' => 'CONVENIOS INTERINSTITUCIONALES', 'sigla' => 'CI', 'estado' => 'A', 'unidades_id' => 1],
            ['descrip' => 'CARTAS RECIBIDAS', 'sigla' => 'CR', 'estado' => 'A', 'unidades_id' => 1],
            ['descrip' => 'RESOLUCIONES', 'sigla' => 'RA', 'estado' => 'A', 'unidades_id' => 2],
            ['descrip' => 'INSTRUCTIVOS', 'sigla' => 'IA', 'estado' => 'A', 'unidades_id' => 2],
            ['descrip' => 'CARTAS', 'sigla' => 'CA', 'estado' => 'A', 'unidades_id' => 2],
            ['descrip' => 'CIRCULARES', 'sigla' => 'LA', 'estado' => 'A', 'unidades_id' => 2],
            ['descrip' => 'ESTADISTICAS', 'sigla' => 'EA', 'estado' => 'A', 'unidades_id' => 2],
            ['descrip' => 'CENTRALIZADORES', 'sigla' => 'CA', 'estado' => 'A', 'unidades_id' => 2],
            ['descrip' => 'REGISTRO GRADO', 'sigla' => 'GA', 'estado' => 'A', 'unidades_id' => 2],
            ['descrip' => 'ASISTENCIA', 'sigla' => 'AD', 'estado' => 'A', 'unidades_id' => 3],
            ['descrip' => 'POA', 'sigla' => 'PD', 'estado' => 'A', 'unidades_id' => 3],
            ['descrip' => 'BAJAS', 'sigla' => 'BD', 'estado' => 'A', 'unidades_id' => 3],
            ['descrip' => 'INFORMES', 'sigla' => 'FD', 'estado' => 'A', 'unidades_id' => 3],
            ['descrip' => 'INSTRUCTIVOS', 'sigla' => 'ID', 'estado' => 'A', 'unidades_id' => 3],
            ['descrip' => 'INVENTARIOS', 'sigla' => 'VD', 'estado' => 'A', 'unidades_id' => 3],
            ['descrip' => 'ESTADOS FINANCIEROS', 'sigla' => 'EF', 'estado' => 'A', 'unidades_id' => 3],
            ['descrip' => 'EXTRACTOS', 'sigla' => 'XD', 'estado' => 'A', 'unidades_id' => 3],
            ['descrip' => 'CIRCULARES', 'sigla' => 'LD', 'estado' => 'A', 'unidades_id' => 3],
            ['descrip' => 'CARTAS', 'sigla' => 'CD', 'estado' => 'A', 'unidades_id' => 3],
        ];

        $documentos = [
            
        ];


        Cargo::insert($cargos); // Se crea un cargo por cada elemento del array
        Gestion::insert($gestions); // Se crea un cargo por cada elemento del array
        Institucion::insert($institucions); // Se crea un cargo por cada elemento del array
        Unidad::insert($unidades); // Se crea un cargo por cada elemento del array
        Persona::insert($personas); // Se crea un cargo por cada elemento del array
        User::insert($users); // Se crea un cargo por cada elemento del array
        Categoria::insert($categorias_doc); // Se crea un cargo por cada elemento del array

        /* User::factory()->create([
            #'name' => 'Francklin',
            'email' => 'admin@gmail.com',
            'password' => '123',
            'role' => 'A'
        ]); */
    }
}
