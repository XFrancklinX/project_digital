@extends('layouts.app')

@section('sidebar-nav')
<!-- Sidebar wrapper start -->
<nav class="sidebar-wrapper">

    <!-- Sidebar brand starts -->
    <div class="sidebar-brand">
        <a href="index.html" class="logo">
            <img src="images/logo.svg" alt="Dashboard" />
        </a>
    </div>
    <!-- Sidebar brand starts -->

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

                <li>
                    <a href="{{route('correspondencia')}}">
                        <i class="bi bi-stickies"></i>
                        <span class="menu-text">Correspondencia</span>
                    </a>
                </li>

                <li class="active-page-link">
                    <a href="{{route('gestion')}}">
                        <i class="bi bi-diagram-3"></i>
                        <span class="menu-text">Gestión</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Sidebar menu ends -->

</nav>
@endsection
@section('content')
@php
use App\Models\Persona;
use App\Models\Unidad;
use App\Models\Documento;
use App\Models\Cargo;

$unidades = Unidad::all();
$cargos = Cargo::all();
@endphp

<!-- Page header starts -->
<div class="page-header">
    <div class="toggle-sidebar" id="toggle-sidebar"><i class="bi bi-list"></i></div>


    <!-- Breadcrumb start -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="bi bi-house"></i>
            <a href="index.html">Principal</a>
        </li>
        <li class="breadcrumb-item breadcrumb-active" aria-current="page">Gestión</li>
    </ol>

    <!-- Header actions ccontainer start -->
    <div class="header-actions-container">
        <div class="toggle-sidebar" id="toggle-sidebar"><i class="bi bi-list"></i></div>

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
                        <img src="images/user.png" alt="Admin Templates">
                        <span class="status online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userSettings">
                    <div class="header-profile-actions">
                        <a href="profile.html">Perfil</a>
                        <a href="login.html">Salir</a>
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
                <div class="card-body">
                    <div class="custom-tabs-container">
                        <ul class="nav nav-tabs" id="customTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="tab-one" data-bs-toggle="tab" href="#one" role="tab"
                                    aria-controls="one" aria-selected="true">Personas</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tab-two" data-bs-toggle="tab" href="#two" role="tab"
                                    aria-controls="two" aria-selected="false">Unidades</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tab-three" data-bs-toggle="tab" href="#three" role="tab"
                                    aria-controls="three" aria-selected="false">Categorias</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tab-four" data-bs-toggle="tab" href="#four" role="tab"
                                    aria-controls="four" aria-selected="false">Instituciones</a>
                            </li>
                        </ul>
                        @include('includes.add-gestion')

                        <div class="tab-content" id="customTabContent">
                            <div class="tab-pane fade show active" id="one" role="tabpanel">
                                <button class="btn btn-info mb-3" id="btn-personas">
                                    <i class="bi bi-plus-square"></i>
                                    Agregar
                                </button>
                                <table class="table table-bordered" id="table1" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Documento</th>
                                            <th>Unidad</th>
                                            <th>Fecha</th>
                                            <th>Destinatario</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>Documento 1</td>
                                            <td>Unidad 1</td>
                                            <td>Fecha 1</td>
                                            <td>Destinatario 1</td>
                                            <td>
                                                <button class="btn btn-info">
                                                    <i class="bi bi-pencil-square"></i>
                                                    Editar
                                                </button>
                                                <button class="btn btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                    Eliminar
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="two" role="tabpanel">
                                <button class="btn btn-info mb-3" id="btn-unidades">
                                    <i class="bi bi-plus-square"></i>
                                    Agregar
                                </button>
                                <table class="table table-bordered" id="table2" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Documento</th>
                                            <th>Unidad</th>
                                            <th>Fecha</th>
                                            <th>Destinatario</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>Documento 1</td>
                                            <td>Unidad 1</td>
                                            <td>Fecha 1</td>
                                            <td>Destinatario 1</td>
                                            <td>
                                                <button class="btn btn-info">
                                                    <i class="bi bi-pencil-square"></i>
                                                    Editar
                                                </button>
                                                <button class="btn btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                    Eliminar
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="three" role="tabpanel">
                                <button class="btn btn-info mb-3" id="btn-categorias">
                                    <i class="bi bi-plus-square"></i>
                                    Agregar
                                </button>
                                <table class="table table-bordered" id="table3" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Documento</th>
                                            <th>Unidad</th>
                                            <th>Fecha</th>
                                            <th>Destinatario</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>Documento 1</td>
                                            <td>Unidad 1</td>
                                            <td>Fecha 1</td>
                                            <td>Destinatario 1</td>
                                            <td>
                                                <button class="btn btn-info">
                                                    <i class="bi bi-pencil-square"></i>
                                                    Editar
                                                </button>
                                                <button class="btn btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                    Eliminar
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="four" role="tabpanel">
                                <button class="btn btn-info mb-3" id="btn-instituciones">
                                    <i class="bi bi-plus-square"></i>
                                    Agregar
                                </button>
                                <table class="table table-bordered" id="table3" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Documento</th>
                                            <th>Unidad</th>
                                            <th>Fecha</th>
                                            <th>Destinatario</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>Documento 1</td>
                                            <td>Unidad 1</td>
                                            <td>Fecha 1</td>
                                            <td>Destinatario 1</td>
                                            <td>
                                                <button class="btn btn-info">
                                                    <i class="bi bi-pencil-square"></i>
                                                    Editar
                                                </button>
                                                <button class="btn btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                    Eliminar
                                                </button>
                                            </td>
                                        </tr>
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