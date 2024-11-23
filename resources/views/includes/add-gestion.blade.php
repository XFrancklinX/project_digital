<!-- Modal 2 -->
<div class="modal fade" id="modal-add-gestion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div id="tittle-personas">
                    <h5 class="modal-title" id="staticBackdropLabel">Agregar Personas</h5>
                </div>
                <div id="tittle-unidades">
                    <h5 class="modal-title" id="staticBackdropLabel">Agregar Unidades</h5>
                </div>
                <div id="tittle-categorias">
                    <h5 class="modal-title" id="staticBackdropLabel">Agregar Categorias</h5>
                </div>
                <div id="tittle-instituciones">
                    <h5 class="modal-title" id="staticBackdropLabel">Agregar Instituciones</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="section-personas">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 col-12 mb-3">
                                <label for="" class="form-label">Nombre(s)</label>
                                <input type="text" class="form-control" id="" name="" placeholder="" required="">
                            </div>
                            <div class="col-sm-6 col-12 mb-3">
                                <label for="" class="form-label">Apellido Paterno</label>
                                <input type="text" class="form-control" id="" name="" placeholder="" required="">
                            </div>
                            <div class="col-sm-6 col-12 mb-3">
                                <label for="" class="form-label">Apellido Materno</label>
                                <input type="text" class="form-control" id="" name="" placeholder="" required="">
                            </div>
                            <div class="col-sm-6 col-12 mb-3">
                                <label for="" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="" name="" placeholder="" required="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-12 mb-3">
                                <label for="" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="" name="" placeholder="" required="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-12 mb-3">
                                <div class="m-0">
                                    <label class="form-label d-flex">Unidad Administrativa</label>
                                    <select class="select-unidad-panel js-states form-control select-single" title="Seleccione la Unidad Administrativa"
                                        data-live-search="true" name="unidades_id" id="offunidades_id" required="">
                                        <option value="0">Seleccionar</option>
                                        @foreach ($unidades as $unidad)
                                        <option value="{{$unidad->id}}">{{$unidad->id}}. {{$unidad->descrip}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12 mb-3">
                                <div class="m-0">
                                    <label class="form-label d-flex">Cargo</label>
                                    <select class="select-cargo js-states form-control select-single" title="Seleccione la Unidad Administrativa"
                                        data-live-search="true" name="cargos_id" id="cargos_id" required="">
                                        <option value="0">Seleccionar</option>
                                        @foreach ($cargos as $cargo)
                                        <option value="{{$cargo->id}}">{{$cargo->id}}. {{$cargo->descrip}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="section-unidades">
                    <div class="row">
                        <div class="col-sm-12 col-12 mb-3">
                            <label for="" class="form-label">Nueva Unidad</label>
                            <input type="text" class="form-control" id="" name="" placeholder="" required="">
                        </div>
                    </div>
                </div>
                <div id="section-categorias">
                    <div class="row" id="row-categorias">
                        <div class="col-sm-12 col-12 mb-3">
                            <label for="" class="form-label col-sm-12 col-12">Nueva Categoria</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="" name="" placeholder="" required="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-12 mb-3">
                                <button type="button" class="btn btn-info" id="btn-add-categoria"><i class="bi bi-plus-square"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="section-instituciones">
                    <div class="row">
                        <div class="col-sm-12 col-12 mb-3">
                            <label for="" class="form-label">Nueva Institución</label>
                            <input type="text" class="form-control" id="" name="" placeholder="" required="">
                        </div>
                        <div class="col-sm-12 col-12 mb-3">
                            <label for="" class="form-label">Ciudad</label>
                            <input type="text" class="form-control" id="" name="" placeholder="" required="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Agregar</button>
            </div>
        </div>
    </div>
</div>