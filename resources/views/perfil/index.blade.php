@extends('layouts.app')

@section('sidebar-nav')
<!-- Sidebar wrapper start -->
<nav class="sidebar-wrapper">

    <!-- Sidebar brand starts -->
    <div class="sidebar-brand">
        <a href="{{route('dashboard')}}" class="logo">
            <img src="images/images.png" alt="Principal" />
        </a>
    </div>
    <!-- Sidebar brand starts -->

    <!-- Sidebar menu starts -->
    <div class="sidebar-menu">
        <div class="sidebarMenuScroll">
            <ul>
                <li class="active-page-link">
                    <a href="{{route('dashboard')}}">
                        <i class="bi bi-house"></i>
                        <span class="menu-text">Principal</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('correspondencia')}}">
                        <i class="bi bi-stickies"></i>
                        <span class="menu-text">Digitalización</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('gestion')}}">
                        <i class="bi bi-diagram-3"></i>
                        <span class="menu-text">Gestión</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('reportes')}}">
                        <i class="bi bi-graph-up"></i>
                        <span class="menu-text">Reportes</span>
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
            <a href="{{route('dashboard')}}">Principal</a>
        </li>
        <li class="breadcrumb-item breadcrumb-active" aria-current="page">Perfil</li>
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
                        <img src="images/images.png" alt="User Image">
                        <span class="status online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userSettings">
                    <div class="header-profile-actions">
                        <a href="{{route('perfil')}}">Perfil</a>
                        <a href="#">Salir</a>
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
        <div class="row gutters">
            <div class="col-sm-12 col-12">

                <div class="profile-header">
                    <h1>Bienvenido(a),
                        @if(Auth::user()->personas_id != null)
                        {{Persona::find(Auth::user()->personas_id)->nombres}}
                        @else
                        {{Auth::user()->email}}
                        @endif
                    </h1>
                    <div class="profile-header-content">
                        <div class="profile-header-tiles">
                            <div class="row gutters">
                                <div class="col-sm-4 col-12">
                                    <div class="profile-tile">
                                        <span class="icon">
                                            <i class="bi bi-pentagon"></i>
                                        </span>
                                        <h6>Nombre(s) - <span>
                                                @if(Auth::user()->personas_id != null)
                                                {{Persona::find(Auth::user()->personas_id)->nombres}} {{Persona::find(Auth::user()->personas_id)->apell_pat}} {{Persona::find(Auth::user()->personas_id)->apell_mat}}
                                                @else
                                                {{Auth::user()->email}}
                                                @endif
                                            </span>
                                        </h6>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-12">
                                    <div class="profile-tile">
                                        <span class="icon">
                                            <i class="bi bi-pin-angle"></i>
                                        </span>
                                        <h6>Dirección -
                                            <span>
                                                @if(Auth::user()->personas_id != null)
                                                {{Persona::find(Auth::user()->personas_id)->direccion}}
                                                @else
                                                No Disponible
                                                @endif
                                            </span>
                                        </h6>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-12">
                                    <div class="profile-tile">
                                        <span class="icon">
                                            <i class="bi bi-telephone"></i>
                                        </span>
                                        <h6>Teléfono -
                                            <span>
                                                @if(Auth::user()->personas_id != null)
                                                {{Persona::find(Auth::user()->personas_id)->telefono}}
                                                @else
                                                No Disponible
                                                @endif
                                            </span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-avatar-tile">
                            <img src="images/images.png" class="img-fluid"
                                alt="Perfil Image" />
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Row start -->
        <div class="row">
            <div class="col-xl-12">
                <!-- Card start -->
                <div class="card">
                    <div class="card-body">

                        <!-- Row start -->
                        <div class="row">
                            <div class="col-xxl-8 col-lg-7 col-md-6 col-sm-12 col-12">
                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <div class="d-flex flex-row">
                                            <img src="images/images.png" class="img-fluid change-img-avatar border rounded" alt="Image">
                                            <div class="image-change">
                                                <img src="images/images.png" class=" img-fluid change-img-avatar border rounded" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-12">
                                        <h5>Información Personal</h5>
                                    </div>
                                    <hr>
                                    <div class="col-xxl-4 col-sm-4 col-12">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="" class="form-label">Nombre(s)</label>
                                            <input type="text" class="form-control" id="" name="" value="{{Persona::find(Auth::user()->personas_id)->nombres}}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-sm-4 col-12">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="" class="form-label">Apellido Paterno</label>
                                            <input type="text" class="form-control" id="" name="" value="{{Persona::find(Auth::user()->personas_id)->apell_pat}}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-sm-4 col-12">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="phoneNo" class="form-label">Apellido Materno</label>
                                            <input type="text" class="form-control" id="" name="" value="{{Persona::find(Auth::user()->personas_id)->apell_mat}}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-sm-6 col-12">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="" class="form-label">Telefono</label>
                                            <input type="text" class="form-control" id="" name="" value="{{Persona::find(Auth::user()->personas_id)->telefono}}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-sm-6 col-12">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="" class="form-label">Dirección</label>
                                            <input type="text" class="form-control" id="" name="" value="{{Persona::find(Auth::user()->personas_id)->direccion}}" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-12">
                                        <h5>Información de Acceso</h5>
                                    </div>
                                    <hr>
                                    <div class="col-xxl-4 col-sm-6 col-12">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="" class="form-label">Grado</label>
                                            <input type="text" class="form-control" id="" name="" value="{{Persona::find(Auth::user()->personas_id)->grado}}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-sm-6 col-12">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="" class="form-label">Rol</label>
                                            <input type="text" class="form-control" id="" name="" value="{{Auth::user()->role}}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label d-flex">Unidad</label>
                                            <select class="select-unidad-perfil js-states form-control select-single" title="Seleccione la Unidad Administrativa"
                                                data-live-search="true" name="unidades_id" id="unidades_id">
                                                @if(Persona::find(Auth::user()->personas_id)->unidades_id != 0)
                                                <option value="{{Persona::find(Auth::user()->personas_id)->unidades_id}}">
                                                    {{Unidad::find(Persona::find(Auth::user()->personas_id)->unidades_id)->id}}. {{Unidad::find(Persona::find(Auth::user()->personas_id)->unidades_id)->descrip}}
                                                </option>
                                                @else
                                                <option value="0">NINGUNA</option>
                                                @endif
                                                @foreach ($unidades as $unidad)
                                                <option value="{{$unidad->id}}">{{$unidad->id}}. {{$unidad->descrip}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xxl-4 col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label d-flex">Cargo</label>
                                            <select class="select-cargo-perfil js-states form-control select-single" title="Seleccione El Cargo"
                                                data-live-search="true" name="cargos_id" id="cargos_id">
                                                @if(Persona::find(Auth::user()->personas_id)->cargos_id != 0)
                                                <option value="{{Persona::find(Auth::user()->personas_id)->cargos_id}}">
                                                    {{Cargo::find(Persona::find(Auth::user()->personas_id)->cargos_id)->id}}. {{Cargo::find(Persona::find(Auth::user()->personas_id)->cargos_id)->descrip}}
                                                </option>
                                                @else
                                                <option value="0">NINGUNA</option>
                                                @endif
                                                @foreach ($cargos as $cargo)
                                                <option value="{{$cargo->id}}">{{$cargo->id}}. {{$cargo->descrip}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-12">
                                        <h5>Datos de Acceso</h5>
                                    </div>
                                    <hr>
                                    <div class="col-xxl-4 col-sm-6 col-12">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="" class="form-label">Usuario</label>
                                            <input type="email" class="form-control" id="" name="" value="{{Auth::user()->email}}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-sm-6 col-12">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="" name="" value="{{Auth::user()->password}}" placeholder="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-lg-5 col-md-6 col-sm-12 col-12">
                                <div class="account-settings-block">

                                </div>
                            </div>
                            <div class="col-sm-12 col-12">
                                <hr>
                                <button class="btn btn-info">Actualizar Información</button>
                            </div>
                        </div>
                        <!-- Row end -->

                    </div>
                </div>
                <!-- Card end -->
            </div>
        </div>
    </div>
</div>
@endsection