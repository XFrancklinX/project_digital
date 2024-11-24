<!-- Offcanvas Right -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="add-persona" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Agregar Persona</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="card">
            <form action="{{route('personas.store')}}" method="POST" enctype="multipart/form-data" id="off-add-personas">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-12 mb-3">
                            <label for="" class="form-label">Nombre(s)</label>
                            <input type="text" class="form-control" id="nombres" name="nombres" placeholder="" oninput="this.value = this.value.toUpperCase()">
                        </div>
                        <div class="col-sm-6 col-12 mb-3">
                            <label for="" class="form-label">Apellido Paterno</label>
                            <input type="text" class="form-control" id="apell_pat" name="apell_pat" placeholder="" oninput="this.value = this.value.toUpperCase()">
                        </div>
                        <div class="col-sm-6 col-12 mb-3">
                            <label for="" class="form-label">Apellido Materno</label>
                            <input type="text" class="form-control" id="apell_mat" name="apell_mat" placeholder="" oninput="this.value = this.value.toUpperCase()">
                        </div>
                        <div class="col-sm-6 col-12 mb-3">
                            <label for="" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-12 mb-3">
                            <label for="" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="" oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-12 mb-3">
                            <div class="m-0">
                                <label class="form-label d-flex">Unidad Administrativa</label>
                                <select class="select-unidad-panel js-states form-control select-single" title="Seleccione la Unidad Administrativa"
                                    data-live-search="true" name="offunidades_id" id="offunidades_id">
                                    <option value="0">Ninguna</option>
                                    @foreach ($unidades as $unidad)
                                    <option value="{{$unidad->id}}">{{$unidad->id}}. {{$unidad->descrip}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6 col-12 mb-3">
                            <div class="m-0">
                                <label class="form-label d-flex">Cargo</label>
                                <select class="select-cargo-panel js-states form-control select-single" title="Seleccione la Unidad Administrativa"
                                    data-live-search="true" name="offcargos_id" id="offcargos_id">
                                    <option value="0">Ninguna</option>
                                    @foreach ($cargos as $cargo)
                                    <option value="{{$cargo->id}}">{{$cargo->id}}. {{$cargo->descrip}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="offcanvas">Cerrar</button>
                    <button type="submit" class="btn btn-success">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>