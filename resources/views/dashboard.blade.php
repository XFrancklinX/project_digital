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
use App\Models\Documento;

$unidades = Unidad::all();
@endphp

<!-- Page header starts -->
<div class="page-header">

    <div class="toggle-sidebar" id="toggle-sidebar"><i class="bi bi-list"></i></div>

    <!-- Welcome start -->
    <div class="welcome-note">
        Bienvenido(a), <span>
            @if(Auth::user()->personas_id != null)
            {{Persona::find(Auth::user()->personas_id)->nombres}}
            @else
            {{Auth::user()->email}}
            @endif
        </span>
    </div>
    <!-- Welcome end -->

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
        <div class="col-sm-12 col-12 d-xxl-flex d-xl-flex d-sm-block">
            <div class="col-xxl-6 col-xl-6 col-sm-6 col-12">
                <!-- Row start -->
                <div class="row">
                    <div class="col-xxl-6 col-xl-6 col-sm-6 col-12">
                        <div class="stats-tile">
                            <div class="sale-icon-bdr">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                            <div class="sale-details">
                                <h5>Archivos Totales</h5>
                                <h3 class="text-blue">{{Documento::count()}}</h3>
                                <p class="growth text-blue">INTERNA: {{Documento::where('tipo_doc', 'INTERNA')->count()}}</p>
                                <p class="growth text-blue">EXTERNA: {{Documento::where('tipo_doc', 'EXTERNA')->count()}}</p>
                            </div>
                        </div>
                    </div>

                    @foreach ($unidades as $data)
                    <div class="col-xxl-6 col-xl-6 col-sm-6 col-12">
                        <div class="stats-tile">
                            <div class="sale-icon-bdr">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                            <div class="sale-details">
                                <h5>{{$data->descrip}}</h5>
                                <h3 class="text-blue">{{Documento::where('unidades_id', $data->id)->count()}}</h3>
                                <p class="growth text-blue">INTERNA: {{Documento::where('unidades_id', $data->id)->where('tipo_doc', 'INTERNA')->count()}}</p>
                                <p class="growth text-blue">EXTERNA: {{Documento::where('unidades_id', $data->id)->where('tipo_doc', 'EXTERNA')->count()}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="col-xl-6 col-sm-6 col-12 px-2">
                <div class="card">
                    <div class="card-body">
                        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="images/images.png" class="d-block w-100" alt="Best Admin Dashboards">
                                    <div class="carousel-caption d-none d-md-block text-black">
                                        <h5>Primer Slide</h5>
                                        <p>Contenido del Primer Slide.</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="images/images.png" class="d-block w-100" alt="Best Admin Dashboards">
                                    <div class="carousel-caption d-none d-md-block text-black">
                                        <h5>Segundo Slide</h5>
                                        <p>Contenido del Segundo Slide</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="images/images.png" class="d-block w-100" alt="Best Admin Dashboards">
                                    <div class="carousel-caption d-none d-md-block text-black">
                                        <h5>Tercer Slide</h5>
                                        <p>Contenido del Tercer Slide</p>
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection