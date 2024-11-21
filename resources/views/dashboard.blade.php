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
        Bienvenido, <span>
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
        <div class="col-sm-12 col-12 border border-5 d-xxl-flex d-xl-flex d-sm-block">
            <div class="col-sm-6 col-12 border border-5">
                <!-- Row start -->
                <div class="row">
                    <div class="col-xxl-3 col-xl-6 col-sm-6 col-12">
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
                    <div class="col-xxl-3 col-xl-6 col-sm-6 col-12">
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

            <div class="col-sm-6 col-12 border border-5">

            </div>
        </div>
    </div>
</div>
@endsection