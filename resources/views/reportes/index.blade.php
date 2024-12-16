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

            @if(Auth::user()->role != 'C')
            <li class="sidebar-dropdown">
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
                            <a href="{{route('anulados')}}">Anulados</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li>
                <a href="{{route('gestion')}}">
                    <i class="bi bi-diagram-3"></i>
                    <span class="menu-text">Gestión</span>
                </a>
            </li>
            @endif

            <li class="active-page-link">
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
use App\Models\Documento;
use App\Models\Cargo;
use App\Models\Institucion;

$personas = Persona::all();
$unidades = Unidad::all();
$categorias = Categoria::all();
$cargos = Cargo::all();
$instituciones = Institucion::all();
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
        <li class="breadcrumb-item breadcrumb-active" aria-current="page">Reportes</li>
    </ol>

    <!-- Header actions container start -->
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
        <!-- Row start -->
        <div class="col-xxl-12 col-xl-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div id="modal-content"></div>
                </div>
                <div class="card-body d-sm-flex d-block">
                    <div class="col-sm-4 col-12 px-2">
                        <!-- Card start -->
                        <div class="m-0">
                            <label class="form-label">Unidad Administrativa</label>
                            <select class="select-unidad-report js-states form-control select-single" title="Seleccione la Unidad Administrativa"
                                data-live-search="true" name="unidades_id" id="unidades_id" required="">
                                <option value="0">Seleccionar</option>
                                @foreach ($unidades as $unidad)
                                <option value="{{$unidad->id}}">{{$unidad->id}}. {{$unidad->descrip}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4 col-12 px-2">
                        <!-- Card start -->
                        <div class="m-0">
                            <label class="form-label">Categoria</label>
                            <select class="select-categoria-report js-states form-control select-single" title="Seleccione la Categoria"
                                data-live-search="true" name="categorias_id" id="report_categorias_id" required="">
                                <option value="0">Seleccionar</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4 col-12 px-2">
                        <!-- Card start -->
                        <div class="m-0">
                            <div class="form-label">Rango de fechas</div>
                            <div class="input-group">

                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-calendar2-range"></i>
                                    </span>
                                    <input type="text" class="form-control custom-daterange2">
                                    <button class="btn btn-info" id="btn-filtrar"><i class="bi bi-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="col-sm-12 col-12">
                        <table class="table table-bordered" id="table-report" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Código</th>
                                    <th>Unidad</th>
                                    <th>Cite</th>
                                    <th>Referencia</th>
                                    <th>Tipo</th>
                                    <th>Registro</th>
                                    <th>Archivo</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection