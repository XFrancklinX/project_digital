@extends('layouts.app')

@section('sidebar-nav')
<style>
    .change-img-avatar {
        margin: 0px;
    }

    .file-upload-label {
        width: 120px;
        height: 100px;
        display: inline-block;
        padding: 20px 20px;
        background-color: #f0f0f0;
        border: 2px dashed #888;
        cursor: pointer;
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
        color: #888;
        transition: 0.3s ease;
        /* margin-top: 10px; */
    }

    .file-upload-label:hover {
        background-color: #e0e0e0;
    }

    .file-upload-input {
        display: none;
        /* Ocultamos el input de tipo file */
    }

    .image-change {
        margin-left: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .img-fluid.change-img-avatar {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        /* Asegura que la imagen sea redonda */
    }
</style>

<!-- Sidebar menu starts -->
<div class="sidebar-menu">
    <div class="sidebarMenuScroll">
        <ul>
            <li class="">
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
        <div class="row gutters">
            <div class="col-sm-12 col-12">
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
                            @if(Auth::user()->image != null || Auth::user()->image != '')
                            <img src="images/users/{{Auth::user()->image}}" class="img-fluid"
                                alt="Perfil Image" />
                            @else
                            <img src="images/users/users.webp" class="img-fluid"
                                alt="Perfil Image" />
                            @endif
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
                        <form action="{{route('perfil.update', Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xxl-8 col-lg-7 col-md-6 col-sm-12 col-12">
                                    <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <div class="d-flex flex-row">
                                                <div class="image-preview border">
                                                    @if(Auth::user()->image != null || Auth::user()->image != '')
                                                    <img src="images/users/{{Auth::user()->image}}" class="img-fluid change-img-avatar" alt="User Image" id="avatar" />
                                                    @else
                                                    <img src="images/users/users.webp" class="img-fluid change-img-avatar" alt="User Image" id="avatar" />
                                                    @endif
                                                </div>
                                                <div class="image-change">
                                                    <input type="number" name="inserted" value="0" hidden readonly>
                                                    <input type="file" class="file-upload-input" id="file-upload" accept="image/*" onchange="previewImage(event)" name="image">
                                                    <label for="file-upload" class="file-upload-label text-center">
                                                        <span class="file-upload-text">Cambiar Imagen</span>
                                                    </label>
                                                </div>
                                                <script>
                                                    function previewImage(event) {
                                                        var output = document.getElementById('avatar'); // Imagen de perfil que se va a actualizar
                                                        var file = event.target.files[0]; // Obtiene el archivo seleccionado

                                                        if (file) {
                                                            var reader = new FileReader();

                                                            reader.onload = function() {
                                                                // Actualiza la imagen de perfil con la nueva imagen
                                                                output.src = reader.result;
                                                            };

                                                            reader.readAsDataURL(file);

                                                            // Cambia el valor de inserted a 1 para indicar que se ha insertado una imagen
                                                            document.querySelector('input[name="inserted"]').value = 1;
                                                        }
                                                    }
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input type="number" name="users_id" value="{{Auth::user()->id}}" hidden readonly>
                                        <div class="col-sm-12 col-12">
                                            <h5>Información Personal</h5>
                                        </div>
                                        <hr>
                                        <div class="col-xxl-4 col-sm-4 col-12">
                                            <!-- Form Field Start -->
                                            <div class="mb-3">
                                                <label for="" class="form-label">Nombre(s)</label>
                                                <input type="text" class="form-control" id="nombres" name="nombres" value="{{Persona::find(Auth::user()->personas_id)->nombres}}" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-sm-4 col-12">
                                            <!-- Form Field Start -->
                                            <div class="mb-3">
                                                <label for="" class="form-label">Apellido Paterno</label>
                                                <input type="text" class="form-control" id="apell_pat" name="apell_pat" value="{{Persona::find(Auth::user()->personas_id)->apell_pat}}" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-sm-4 col-12">
                                            <!-- Form Field Start -->
                                            <div class="mb-3">
                                                <label for="phoneNo" class="form-label">Apellido Materno</label>
                                                <input type="text" class="form-control" id="apell_mat" name="apell_mat" value="{{Persona::find(Auth::user()->personas_id)->apell_mat}}" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-sm-6 col-12">
                                            <!-- Form Field Start -->
                                            <div class="mb-3">
                                                <label for="" class="form-label">Telefono</label>
                                                <input type="text" class="form-control" id="telefono" name="telefono" value="{{Persona::find(Auth::user()->personas_id)->telefono}}" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-sm-6 col-12">
                                            <!-- Form Field Start -->
                                            <div class="mb-3">
                                                <label for="" class="form-label">Dirección</label>
                                                <input type="text" class="form-control" id="direccion" name="direccion" value="{{Persona::find(Auth::user()->personas_id)->direccion}}" placeholder="">
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
                                                <input type="text" class="form-control" id="grado" name="grado" value="{{Persona::find(Auth::user()->personas_id)->grado}}" placeholder="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-sm-6 col-12">
                                            <!-- Form Field Start -->
                                            <div class="mb-3">
                                                <label for="" class="form-label">Rol</label>
                                                <input type="text" class="form-control" id="role" name="role" value="{{Auth::user()->role}}" placeholder="" readonly>
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
                                                <input type="email" class="form-control" id="email" name="email" value="{{Auth::user()->email}}" placeholder="">
                                            </div>
                                        </div>

                                        @if(Auth::user()->role == 'A')
                                        <div class="col-xxl-4 col-sm-6 col-12">
                                            <!-- Change Password -->
                                            <div class="mb-3">
                                                <label for="" class="form-label">Contraseña</label>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="">
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    @if(Auth::user()->role == 'A')
                                    <span class="text-end text-success">Para actualizar la información de tu perfil, debes rellenar todos los campos del formulario.</span>
                                    <div class="col-xxl-4 col-lg-5 col-md-6 col-sm-12 col-12">
                                        <div class="account-settings-block">

                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-12">
                                        <hr>
                                        <button class="btn btn-success" type="submit">Actualizar Información</button>
                                    </div>
                                    @endif
                                </div>
                        </form>
                    </div>
                </div>
                <!-- Card end -->
            </div>
        </div>
    </div>
</div>
@endsection