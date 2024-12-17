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
                            <a href="{{route('correspondencia')}}">Archivados</a>
                        </li>
                        <li>
                            <a href="{{route('anulados')}}" class="current-page">Anulados</a>
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
$documentos = Documento::where('estado', '=', 'B')->get();
$documentos1 = Documento::where('tipo_doc', '=', 'INTERNA')->where('estado', '=', 'B')->get();
$documentos2 = Documento::where('tipo_doc', '=', 'EXTERNA')->where('estado', '=', 'B')->get();
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
                                <table class="table table-bordered" id="table1" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Codigo</th>
                                            <th>Unidad</th>
                                            <th>Categoria</th>
                                            <th>CITE</th>
                                            <th>Referencia</th>
                                            <th>Tipo</th>
                                            <th>Registro</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($documentos as $documento)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$documento->codigo}}</td>
                                            <td>{{Unidad::find($documento->unidades_id)->descrip}}</td>
                                            <td>{{Categoria::find($documento->categorias_id)->descrip}}</td>
                                            <td>{{$documento->identificador}}</td>
                                            <td>{{$documento->referencia}}</td>
                                            <td>{{$documento->tipo_doc}}</td>
                                            <td>{{$documento->fecha_reg}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="two" role="tabpanel">
                                <table class="table table-bordered" id="table2" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Codigo</th>
                                            <th>CITE</th>
                                            <th>Referencia</th>
                                            <th>Tipo</th>
                                            <th>Registro</th>
                                            <th>Gestión</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($documentos1 as $documento)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$documento->codigo}}</td>
                                            <td>{{$documento->identificador}}</td>
                                            <td>{{$documento->referencia}}</td>
                                            <td>{{$documento->tipo_doc}}</td>
                                            <td>{{$documento->fecha_reg}}</td>
                                            <td>{{$documento->gestion}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="three" role="tabpanel">
                                <table class="table table-bordered" id="table3" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Codigo</th>
                                            <th>CITE</th>
                                            <th>Referencia</th>
                                            <th>Tipo</th>
                                            <th>Registro</th>
                                            <th>Gestión</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($documentos2 as $documento)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$documento->codigo}}</td>
                                            <td>{{$documento->identificador}}</td>
                                            <td>{{$documento->referencia}}</td>
                                            <td>{{$documento->tipo_doc}}</td>
                                            <td>{{$documento->fecha_reg}}</td>
                                            <td>{{$documento->gestion}}</td>
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