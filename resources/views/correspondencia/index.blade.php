@extends('layouts.app')

@section('sidebar-nav')
<!-- Sidebar menu starts -->
<div class="sidebar-menu">
    <div class="sidebarMenuScroll">
        <ul>
            <li>
                <a href="{{route('dashboard')}}">
                    <i class="bi bi-house"></i>
                    <span class="menu-text">Principal</span>
                </a>
            </li>

            <li class="sidebar-dropdown active">
                <a href="#">
                    <i class="bi bi-stickies"></i>
                    <span class="menu-text">Digitalización</span>
                </a>
                <div class="sidebar-submenu">
                    <ul>
                        <li>
                            <a href="{{route('correspondencia')}}" class="current-page">Archivados</a>
                        </li>
                        <li>
                            <a href="{{route('anulados')}}">Anulados</a>
                        </li>
                    </ul>
                </div>
            </li>

            @if(Auth::user()->role != 'C')
            <li>
                <a href="{{route('gestion')}}">
                    <i class="bi bi-diagram-3"></i>
                    <span class="menu-text">Gestión</span>
                </a>
            </li>
            @endif

            <li>
                <a href="{{route('reportes')}}">
                    <i class="bi bi-graph-up"></i>
                    <span class="menu-text">Reportes</span>
                </a>
            </li>
        </ul>
    </div>
</div>
@endsection
@section('content')
@php
use App\Models\Persona;
use App\Models\Unidad;
use App\Models\Categoria;
use App\Models\Institucion;
use App\Models\Documento;
use App\Models\User;
use App\Models\Cargo;

$unidades = Unidad::all();
$categorias = Categoria::all();
$personas = Persona::all();
$instituciones = Institucion::all();
$documentos = Documento::where('estado', '=', 'A')->get();
$documentos1 = Documento::where('tipo_doc', '=', 'INTERNA')->where('estado', '=', 'A')->get();
$documentos2 = Documento::where('tipo_doc', '=', 'EXTERNA')->where('estado', '=', 'A')->get();
$cargos = Cargo::all();
@endphp

<!-- Page header starts -->
<div class="page-header">
    <div class="toggle-sidebar" id="toggle-sidebar"><i class="bi bi-list"></i></div>


    <!-- Breadcrumb start -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="bi bi-house"></i>
            <a href="{{route('dashboard')}}">Principal</a>
        </li>
        <li class="breadcrumb-item breadcrumb-active" aria-current="page">Digitalización</li>
    </ol>

    <!-- Header actions ccontainer start -->
    <div class="header-actions-container">

        <!-- Header actions start -->
        <ul class="header-actions">
            <li class="dropdown">
                <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
                    <span class="user-name d-none d-md-block">
                        @if(Auth::user()->personas_id != null)
                        {{Persona::find(Auth::user()->personas_id)->nombres}}
                        @else
                        {{Auth::user()->email}}
                        @endif
                    </span>
                    <span class="avatar">
                        @if(Auth::user()->image != null || Auth::user()->image != '')
                        <img src="images/users/{{Auth::user()->image}}" class="img-fluid"
                            alt="User Image" />
                        @else
                        <img src="images/users/users.webp" class="img-fluid"
                            alt="User Image" />
                        @endif
                        <span class="status online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userSettings">
                    <div class="header-profile-actions">
                        <a href="{{route('perfil')}}">Perfil</a>
                        <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i class=""></i>Salir</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf

                        </form>
                    </div>
                </div>
            </li>
        </ul>
        <!-- Header actions end -->

    </div>
    <!-- Header actions ccontainer end -->

</div>

<!-- Content wrapper scroll start -->
<div class="content-wrapper-scroll">

    <!-- Content wrapper start -->
    <div class="content-wrapper">
        <input type="text" id="role_user" value="{{Auth::user()->role}}" hidden>
        <div id="modal-content">
            <div class="col-12 error" id="error">
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
            </div>
        </div>
        <!-- Row start -->
        <div class="col-xxl-12 col-xl-12 col-sm-12 col-12">
            <div class="card">
                @if(Auth::user()->role != 'C')
                <div class="card-header">
                    <button class="btn btn-info add" id="add" data-bs-toggle="modal"
                        data-bs-target="#modal-add">
                        <i class="bi bi-plus-square"></i>
                        Agregar
                    </button>
                </div>
                @endif
                @include('includes.add')
                <div class="card-body">
                    <div class="custom-tabs-container">
                        <ul class="nav nav-tabs" id="customTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="tab-one" data-bs-toggle="tab" href="#one" role="tab"
                                    aria-controls="one" aria-selected="true">Archivos Totales</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tab-two" data-bs-toggle="tab" href="#two" role="tab"
                                    aria-controls="two" aria-selected="false">Archivos Internos</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tab-three" data-bs-toggle="tab" href="#three" role="tab"
                                    aria-controls="three" aria-selected="false">Archivos Externos</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="customTabContent">
                            <div class="tab-pane fade show active" id="one" role="tabpanel">
                                <div class="d-sm-flex">
                                    <div class="mb-3 font-weight-bold text-dark col-xxl-3 col-xl-3 col-sm-4 col-12 me-1">
                                        <label class="form-label d-flex">Unidad Administrativa</label>
                                        <select class="select-unidad-archivos slct11 form-control unidades-all" title="Seleccione la Unidad Administrativa"
                                            data-live-search="true" name="unidades_id" id="archivos_unidades_id">
                                            <option value="0">Seleccionar</option>
                                            @foreach ($unidades as $unidad)
                                            <option value="{{$unidad->id}}">{{$unidad->id}}. {{$unidad->descrip}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 font-weight-bold text-dark col-xxl-3 col-xl-3 col-sm-4 col-12 me-1">
                                        <label class="form-label d-flex">Categoria</label>
                                        <select class="select-categoria-archivos slct12 form-control categorias-all" title="Seleccione la Unidad Administrativa"
                                            data-live-search="true" name="categorias_id" id="archivos_categorias_id">
                                            <option value="0">Seleccionar</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 font-weight-bold text-dark col-xxl-3 col-xl-3 col-sm-4 col-12 me-1">
                                        <label class="form-label col-12 opacity-0">Buscar</label>
                                        <button type="button" class="btn btn-info" id="btn_buscar_archivos" onclick="getDataCombo($('#archivos_unidades_id').val(), $('#archivos_categorias_id').val(),0,0)"><i class="bi bi-search"></i></button>

                                        <script>
                                            function getDataCombo(unidad_id, categoria_id, interna, externa) {
                                                //console.log("Unidad seleccionada:", unidad_id);
                                                //console.log("Categoria seleccionada:", categoria_id);
                                                //console.log("Internos:", interna);
                                                //console.log("Externos:", externa);
                                                const role_user = $('#role_user').val();
                                                //console.log(role_user);
                                                $.ajax({
                                                    type: "GET",
                                                    url: "{{ route('correspondencia.table') }}",
                                                    data: {
                                                        unidad_id: unidad_id,
                                                        categoria_id: categoria_id,
                                                        interna: interna,
                                                        externa: externa
                                                    },
                                                    success: function(response) {
                                                        console.log(response);
                                                        $('#table1').DataTable().destroy();
                                                        $('#table1 tbody').empty();

                                                        if (role_user == 'A') {
                                                            $.each(response.data, function(index, value) {
                                                                //console.log(value.id);
                                                                $('#table1 tbody').append('<tr><td>' + (index + 1) + '</td><td>' + value.codigo + '</td><td>' + value.descrip + '</td><td>' + value.identificador + '</td><td>' + value.referencia + '</td><td>' + value.tipo_doc + '</td><td>' + value.fecha_reg + '</td><td><button class="btn btn-sm btn-info edit" type="button" data-id="' + value.id + '"><i class="bi bi-pencil-square"></i></button> <button class="btn btn-sm btn-danger anule" type="button" data-id="' + value.id + '"><i class="bi bi-x-square"></i></button></td></tr>');
                                                            });
                                                        } else {
                                                            $.each(response.data, function(index, value) {
                                                                //console.log(value.id);
                                                                $('#table1 tbody').append('<tr><td>' + (index + 1) + '</td><td>' + value.codigo + '</td><td>' + value.descrip + '</td><td>' + value.identificador + '</td><td>' + value.referencia + '</td><td>' + value.tipo_doc + '</td><td>' + value.fecha_reg + '</td><td></td></tr>');
                                                            });
                                                        }
                                                        $('#table1').DataTable();
                                                    }
                                                })
                                            }
                                        </script>
                                    </div>
                                </div>
                                <table class="table table-bordered" id="table1" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Codigo</th>
                                            <th>Unidad</th>
                                            <th>CITE</th>
                                            <th>Referencia</th>
                                            <th>Tipo</th>
                                            <th>Registro</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($documentos as $documento)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$documento->codigo}}</td>
                                            <td>{{Unidad::find($documento->unidades_id)->descrip}}</td>
                                            <td>{{$documento->identificador}}</td>
                                            <td>{{$documento->referencia}}</td>
                                            <td>{{$documento->tipo_doc}}</td>
                                            <td>{{$documento->fecha_reg}}</td>
                                            <td>
                                                @if(Auth::user()->role == 'A')
                                                <button class="btn btn-sm btn-info edit" type="button" data-id="{{$documento->id}}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger anule" type="button" data-id="{{$documento->id}}">
                                                    <i class="bi bi-x-square"></i>
                                                </button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="two" role="tabpanel">
                                <div class="d-sm-flex">
                                    <div class="mb-3 font-weight-bold text-dark col-xxl-3 col-xl-3 col-sm-4 col-12 me-1">
                                        <label class="form-label d-flex">Unidad Administrativa</label>
                                        <select class="select-unidad-archivos slct21 form-control unidades-interna" title="Seleccione la Unidad Administrativa"
                                            data-live-search="true" name="unidades_id" id="archivos_unidades_id1">
                                            <option value="0">Seleccionar</option>
                                            @foreach ($unidades as $unidad)
                                            <option value="{{$unidad->id}}">{{$unidad->id}}. {{$unidad->descrip}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 font-weight-bold text-dark col-xxl-3 col-xl-3 col-sm-4 col-12 me-1">
                                        <label class="form-label d-flex">Categoria</label>
                                        <select class="select-categoria-archivos slct22 form-control categorias-interna" title="Seleccione la Unidad Administrativa"
                                            data-live-search="true" name="categorias_id" id="archivos_categorias_id1">
                                            <option value="0">Seleccionar</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 font-weight-bold text-dark col-xxl-3 col-xl-3 col-sm-4 col-12 me-1">
                                        <label class="form-label col-12 opacity-0">Buscar</label>
                                        <button type="button" class="btn btn-info" id="btn_buscar_archivos" onclick="getDataCombo1($('#archivos_unidades_id1').val(), $('#archivos_categorias_id1').val(),1,0)"><i class="bi bi-search"></i></button>

                                        <script>
                                            function getDataCombo1(unidad_id, categoria_id, interna, externa) {
                                                //console.log("Unidad seleccionada:", unidad_id);
                                                //console.log("Categoria seleccionada:", categoria_id);
                                                //console.log("Internos:", interna);
                                                //console.log("Externos:", externa);
                                                const role_user = $('#role_user').val();
                                                $.ajax({
                                                    type: "GET",
                                                    url: "{{ route('correspondencia.table') }}",
                                                    data: {
                                                        unidad_id: unidad_id,
                                                        categoria_id: categoria_id,
                                                        interna: interna,
                                                        externa: externa
                                                    },
                                                    success: function(response) {
                                                        //console.log(response);
                                                        $('#table2').DataTable().destroy();
                                                        $('#table2 tbody').empty();
                                                        if (role_user == 'A') {
                                                            $.each(response.data, function(index, value) {
                                                                //console.log(value.id);
                                                                $('#table2 tbody').append('<tr><td>' + (index + 1) + '</td><td>' + value.codigo + '</td><td>' + value.descrip + '</td><td>' + value.identificador + '</td><td>' + value.referencia + '</td><td>' + value.tipo_doc + '</td><td>' + value.fecha_reg + '</td><td><button class="btn btn-sm btn-info edit" type="button" data-id="' + value.id + '"><i class="bi bi-pencil-square"></i></button> <button class="btn btn-sm btn-danger anule" type="button" data-id="' + value.id + '"><i class="bi bi-x-square"></i></button></td></tr>');
                                                            });
                                                        } else {
                                                            $.each(response.data, function(index, value) {
                                                                //console.log(value.id);
                                                                $('#table2 tbody').append('<tr><td>' + (index + 1) + '</td><td>' + value.codigo + '</td><td>' + value.descrip + '</td><td>' + value.identificador + '</td><td>' + value.referencia + '</td><td>' + value.tipo_doc + '</td><td>' + value.fecha_reg + '</td><td></td></tr>');
                                                            });
                                                        }
                                                        $('#table2').DataTable();
                                                    }
                                                })
                                            }
                                        </script>
                                    </div>
                                </div>
                                <table class="table table-bordered" id="table2" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Codigo</th>
                                            <th>Unidad</th>
                                            <th>CITE</th>
                                            <th>Referencia</th>
                                            <th>Tipo</th>
                                            <th>Registro</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($documentos1 as $documento)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$documento->codigo}}</td>
                                            <td>{{Unidad::find($documento->unidades_id)->descrip}}</td>
                                            <td>{{$documento->identificador}}</td>
                                            <td>{{$documento->referencia}}</td>
                                            <td>{{$documento->tipo_doc}}</td>
                                            <td>{{$documento->fecha_reg}}</td>
                                            <td>
                                                @if(Auth::user()->role == 'A')
                                                <button class="btn btn-sm btn-info edit" type="button" data-id="{{$documento->id}}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger anule" type="button" data-id="{{$documento->id}}">
                                                    <i class="bi bi-x-square"></i>
                                                </button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="three" role="tabpanel">
                                <div class="d-sm-flex">
                                    <div class="mb-3 font-weight-bold text-dark col-xxl-3 col-xl-3 col-sm-4 col-12 me-1">
                                        <label class="form-label d-flex">Unidad Administrativa</label>
                                        <select class="select-unidad-archivos slct31 form-control unidades-externa" title="Seleccione la Unidad Administrativa"
                                            data-live-search="true" name="unidades_id" id="archivos_unidades_id2">
                                            <option value="0">Seleccionar</option>
                                            @foreach ($unidades as $unidad)
                                            <option value="{{$unidad->id}}">{{$unidad->id}}. {{$unidad->descrip}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 font-weight-bold text-dark col-xxl-3 col-xl-3 col-sm-4 col-12 me-1">
                                        <label class="form-label d-flex">Categoria</label>
                                        <select class="select-categoria-archivos slct32 form-control categorias-externa" title="Seleccione la Unidad Administrativa"
                                            data-live-search="true" name="categorias_id" id="archivos_categorias_id2">
                                            <option value="0">Seleccionar</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 font-weight-bold text-dark col-xxl-3 col-xl-3 col-sm-4 col-12 me-1">
                                        <label class="form-label col-12 opacity-0">Buscar</label>
                                        <button type="button" class="btn btn-info" id="btn_buscar_archivos" onclick="getDataCombo2($('#archivos_unidades_id2').val(), $('#archivos_categorias_id2').val(),0,1)"><i class="bi bi-search"></i></button>

                                        <script>
                                            function getDataCombo2(unidad_id, categoria_id, interna, externa) {
                                                //console.log("Unidad seleccionada:", unidad_id);
                                                //console.log("Categoria seleccionada:", categoria_id);
                                                //console.log("Internos:", interna);
                                                //console.log("Externos:", externa);
                                                const role_user = $('#role_user').val();
                                                $.ajax({
                                                    type: "GET",
                                                    url: "{{ route('correspondencia.table') }}",
                                                    data: {
                                                        unidad_id: unidad_id,
                                                        categoria_id: categoria_id,
                                                        interna: interna,
                                                        externa: externa
                                                    },
                                                    success: function(response) {
                                                        //console.log(response);
                                                        $('#table3').DataTable().destroy();
                                                        $('#table3 tbody').empty();
                                                        if (role_user == 'A') {
                                                            $.each(response.data, function(index, value) {
                                                                //console.log(value.id);
                                                                $('#table3 tbody').append('<tr><td>' + (index + 1) + '</td><td>' + value.codigo + '</td><td>' + value.descrip + '</td><td>' + value.identificador + '</td><td>' + value.referencia + '</td><td>' + value.tipo_doc + '</td><td>' + value.fecha_reg + '</td><td><button class="btn btn-sm btn-info edit" type="button" data-id="' + value.id + '"><i class="bi bi-pencil-square"></i></button> <button class="btn btn-sm btn-danger anule" type="button" data-id="' + value.id + '"><i class="bi bi-x-square"></i></button></td></tr>');
                                                            });
                                                        } else {
                                                            $.each(response.data, function(index, value) {
                                                                //console.log(value.id);
                                                                $('#table3 tbody').append('<tr><td>' + (index + 1) + '</td><td>' + value.codigo + '</td><td>' + value.descrip + '</td><td>' + value.identificador + '</td><td>' + value.referencia + '</td><td>' + value.tipo_doc + '</td><td>' + value.fecha_reg + '</td><td></td></tr>');
                                                            });
                                                        }
                                                        $('#table3').DataTable();
                                                    }
                                                })
                                            }
                                        </script>
                                    </div>
                                </div>
                                <table class="table table-bordered" id="table3" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Codigo</th>
                                            <th>Unidad</th>
                                            <th>CITE</th>
                                            <th>Referencia</th>
                                            <th>Tipo</th>
                                            <th>Registro</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($documentos2 as $documento)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$documento->codigo}}</td>
                                            <td>{{Unidad::find($documento->unidades_id)->descrip}}</td>
                                            <td>{{$documento->identificador}}</td>
                                            <td>{{$documento->referencia}}</td>
                                            <td>{{$documento->tipo_doc}}</td>
                                            <td>{{$documento->fecha_reg}}</td>
                                            <td>
                                                @if(Auth::user()->role == 'A')
                                                <button class="btn btn-sm btn-info edit" type="button" data-id="{{$documento->id}}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger anule" type="button" data-id="{{$documento->id}}">
                                                    <i class="bi bi-x-square"></i>
                                                </button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection