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
            <a href="index.html">Principal</a>
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
                        <img src="images/user.png" alt="Admin Templates">
                        <span class="status online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userSettings">
                    <div class="header-profile-actions">
                        <a href="{{route('perfil')}}">Perfil</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
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
        <div class="row gutters">
            <div class="col-sm-12 col-12">

                <div class="profile-header">
                    <h1>Welcome,
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
                            <img src="images/user.png" class="img-fluid"
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
                                            <img src="images/user.png" class="img-fluid change-img-avatar" alt="Image">
                                            <div id="dropzone-sm" class="mb-4 dropzone-dark">
                                                <form action="/upload" class="dropzone needsclick dz-clickable" id="demo-upload">

                                                    <div class="dz-message needsclick">
                                                        <button type="button" class="dz-button">Change Image.</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xxl-4 col-sm-6 col-12">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="fullName" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" id="fullName" placeholder="Full Name">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-sm-6 col-12">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="emailID" class="form-label">Email ID</label>
                                            <input type="email" class="form-control" id="emailID" placeholder="reese@meail.com">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-sm-6 col-12">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="phoneNo" class="form-label">Phone</label>
                                            <input type="number" class="form-control" id="phoneNo" placeholder="123-456-7890">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-sm-6 col-12">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" placeholder="Address">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-sm-6 col-12">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="city" class="form-label">City</label>
                                            <input type="text" class="form-control" id="city" placeholder="City">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-sm-6 col-12">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="state" class="form-label">State</label>
                                            <input type="text" class="form-control" id="state" placeholder="State">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-sm-6 col-12">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="zipCode" class="form-label">Zip Code</label>
                                            <input type="text" class="form-control" id="zipCode" placeholder="Zip Code">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-sm-6 col-12">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="country" class="form-label">Country</label>
                                            <select class="form-control" id="country">
                                                <option>United States</option>
                                                <option>Australia</option>
                                                <option>Canada</option>
                                                <option>Gremany</option>
                                                <option>India</option>
                                                <option>Japan</option>
                                                <option>England</option>
                                                <option>Brazil</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-sm-6 col-12">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="enterPassword" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="enterPassword"
                                                placeholder="Enter Password">
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
                                <button class="btn btn-info">Save Settings</button>
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