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
                                <input type="number" id="id" name="id" value="{{$personas->id}}" hidden readonly>
                                <div class="col-sm-6 col-12 mb-3 px-1">
                                    <label for="" class="form-label">Nombre(s)</label>
                                    <input type="text" class="form-control" id="nombres" name="nombres" value="{{$personas->nombres}}" placeholder="" required="" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="col-sm-6 col-12 mb-3 px-1">
                                    <label for="" class="form-label">Apellido Paterno</label>
                                    <input type="text" class="form-control" id="apell_pat" name="apell_pat" value="{{$personas->apell_pat}}" placeholder="" required="" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="col-sm-6 col-12 mb-3 px-1">
                                    <label for="" class="form-label">Apellido Materno</label>
                                    <input type="text" class="form-control" id="apell_mat" name="apell_mat" value="{{$personas->apell_mat}}" placeholder="" required="" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="col-sm-6 col-12 mb-3 px-1">
                                    <label for="" class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" value="{{$personas->telefono}}" placeholder="" required="">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-12 mb-3 px-1">
                                    <label for="" class="form-label">Dirección</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion" value="{{$personas->direccion}}" placeholder="" required="" oninput="this.value = this.value.toUpperCase()">
                                </div>
                            </div>

                            <div class="row">
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