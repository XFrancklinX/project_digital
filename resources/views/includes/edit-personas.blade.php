<style>
    .row {
        --bs-gutter-x: 0;
        --bs-gutter-y: 0;
        display: flex;
        flex-wrap: wrap;
        margin-top: calc(-1 * var(--bs-gutter-y));
        margin-right: calc(-0.5 * var(--bs-gutter-x));
        margin-left: calc(-0.5 * var(--bs-gutter-x));
    }
</style>

@php
use App\Models\Persona;
use App\Models\Unidad;
use App\Models\Documento;
use App\Models\Cargo;
use App\Models\User;
@endphp

<!-- Modal 2 -->
<div class="modal fade" id="modal-edit-gestion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <div id="tittle-personas">
                    <h5 class="modal-title" id="staticBackdropLabel">Actualizar Personas {{$personas->id}}</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('gestion.personas.update', $personas->id)}}" method="post">
                    @csrf
                    <div id="section-personas">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <h5>Información Personal</h5>
                                </div>
                                <hr>
                                <input type="number" id="id" name="id" value="{{$personas->id}}" hidden readonly>
                                <div class="col-sm-4 col-12 mb-3 px-1">
                                    <label for="" class="form-label">Nombre(s)</label>
                                    <input type="text" class="form-control" id="nombres" name="nombres" value="{{$personas->nombres}}" placeholder="" required="" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="col-sm-4 col-12 mb-3 px-1">
                                    <label for="" class="form-label">Apellido Paterno</label>
                                    <input type="text" class="form-control" id="apell_pat" name="apell_pat" value="{{$personas->apell_pat}}" placeholder="" required="" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="col-sm-4 col-12 mb-3 px-1">
                                    <label for="" class="form-label">Apellido Materno</label>
                                    <input type="text" class="form-control" id="apell_mat" name="apell_mat" value="{{$personas->apell_mat}}" placeholder="" required="" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="col-sm-6 col-12 mb-3 px-1">
                                    <label for="" class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" value="{{$personas->telefono}}" placeholder="" required="">
                                </div>

                                <div class="col-sm-6 col-12 mb-3 px-1">
                                    <label for="" class="form-label">Dirección</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion" value="{{$personas->direccion}}" placeholder="" required="" oninput="this.value = this.value.toUpperCase()">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <h5>Información de Acceso <span class="text-muted">(Opcional)</span></h5>
                                </div>
                                <hr>

                                <div class="col-sm-6 col-12 mb-3 px-1">
                                    <div class="m-0">
                                        <label class="form-label d-flex">Unidad Administrativa</label>
                                        <select class="select-unidad-edit js-states form-control select-single" title="Seleccione la Unidad Administrativa"
                                            data-live-search="true" name="unidades_id" id="unidades_id" required="">
                                            @if(!empty($personas->unidades_id))
                                            <option value="{{$personas->unidades_id}}">{{Unidad::find($personas->unidades_id)->id}}. {{Unidad::find($personas->unidades_id)->descrip}}</option>
                                            @else
                                            <option value="0">Seleccionar</option>
                                            @endif
                                            @foreach ($unidades as $unidad)
                                            <option value="{{$unidad->id}}">{{$unidad->id}}. {{$unidad->descrip}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-12 mb-3 px-1">
                                    <div class="m-0">
                                        <label class="form-label d-flex">Cargo</label>
                                        <select class="select-cargo-edit js-states form-control select-single" title="Seleccione la Unidad Administrativa"
                                            data-live-search="true" name="cargos_id" id="cargos_id" required="">
                                            @if(!empty($personas->cargos_id))
                                            <option value="{{$personas->cargos_id}}">{{Cargo::find($personas->cargos_id)->id}}. {{Cargo::find($personas->cargos_id)->descrip}}</option>
                                            @else
                                            <option value="0">Seleccionar</option>
                                            @endif
                                            @foreach ($cargos as $cargo)
                                            <option value="{{$cargo->id}}">{{$cargo->id}}. {{$cargo->descrip}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-12 px-1">
                                    <!-- Form Field Start -->
                                    <div class="mb-3">
                                        <label for="" class="form-label">Grado</label>
                                        <input type="text" class="form-control" id="grado" name="grado" value="{{$personas->grado}}" placeholder="" readonly>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <h5>Datos de Acceso <span class="text-muted">(Opcional)</span></h5>
                                </div>
                                <hr>
                                <div class="col-sm-6 col-12 px-1">
                                    <!-- Form Field Start -->
                                    <div class="mb-3">
                                        <label for="" class="form-label">Usuario</label>
                                        @if(User::where('personas_id', $personas->id)->exists())
                                        <input type="email" class="form-control" id="email" name="email" value="{{User::where('personas_id', $personas->id)->first()->email}}" placeholder="">
                                        @else
                                        <input type="email" class="form-control" id="email" name="email" value="" placeholder="">
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6 col-12 px-1">
                                    <!-- Change Password -->
                                    <div class="mb-3">
                                        <label for="" class="form-label col-12">Contraseña</label>
                                        @if(User::where('personas_id', $personas->id)->exists())
                                        <button type="button" class="btn btn-dark" id="btn-reset">Resetear Contraseña</button>
                                        <input type="password" id="password" name="reset" value="0" hidden readonly>
                                        @else
                                        <input type="password" id="password" class="form-control" name="password" value="">
                                        @endif
                                    </div>
                                    <script>
                                        $('#btn-reset').on('click', function() {
                                            $('#password').val('1');
                                            console.log($('#password').val());
                                        });
                                    </script>
                                </div>

                                <div class="col-sm-6 col-12 x-1">
                                    <div class="m-0">
                                        <label class="form-label d-flex">Rol</label>
                                        <select class="select-role-edit js-states form-control select-single" title="Seleccione el Rol"
                                            data-live-search="true" name="role" id="role">
                                            @if(User::where('personas_id', $personas->id)->exists())
                                            <option value="{{User::where('personas_id', $personas->id)->first()->role}}">{{User::where('personas_id', $personas->id)->first()->role}}</option>
                                            @else
                                            <option value="C">Seleccionar</option>
                                            @endif
                                            <option value="R">R</option>
                                            <option value="C">C</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Actualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>