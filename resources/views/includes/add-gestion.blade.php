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

<!-- Modal 2 -->
<div class="modal fade" id="modal-add-gestion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
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
                <form action="{{route('gestion.personas.store')}}" method="post">
                    @csrf
                    <div id="section-personas">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <h5>Información Personal</h5>
                                </div>
                                <hr>

                                <div class="col-sm-4 col-12 mb-3 px-1">
                                    <label for="" class="form-label">Nombre(s)</label>
                                    <input type="text" class="form-control" id="nombres" name="nombres" value="" placeholder="" required="" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="col-sm-4 col-12 mb-3 px-1">
                                    <label for="" class="form-label">Apellido Paterno</label>
                                    <input type="text" class="form-control" id="apell_pat" name="apell_pat" value="" placeholder="" required="" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="col-sm-4 col-12 mb-3 px-1">
                                    <label for="" class="form-label">Apellido Materno</label>
                                    <input type="text" class="form-control" id="apell_mat" name="apell_mat" value="" placeholder="" required="" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="col-sm-6 col-12 mb-3 px-1">
                                    <label for="" class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" value="" placeholder="" required="">
                                </div>

                                <div class="col-sm-6 col-12 mb-3 px-1">
                                    <label for="" class="form-label">Dirección</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion" value="" placeholder="" required="" oninput="this.value = this.value.toUpperCase()">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <h5>Información de Acceso <span class="text-muted">(Opcional)</span></h5>
                                </div>
                                <hr>

                                <div class="col-sm-6 col-12 mb-3 px-1">
                                    <div class="m-0">
                                        <label class="form-label">Unidad Administrativa</label>
                                        <select class="select-unidad-add js-states form-control select-single" title="Seleccione la Unidad Administrativa"
                                            data-live-search="true" name="unidades_id" id="unidades_id">
                                            <option value="0">Seleccionar</option>
                                            @foreach ($unidades as $unidad)
                                            <option value="{{$unidad->id}}">{{$unidad->id}}. {{$unidad->descrip}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-12 mb-3 px-1">
                                    <div class="m-0">
                                        <label class="form-label">Cargo&nbsp;</label>
                                        <select class="select-cargo-add js-states form-control select-single" title="Seleccione la Unidad Administrativa"
                                            data-live-search="true" name="cargos_id" id="cargos_id">
                                            <option value="0">Seleccionar</option>
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
                                        <input type="text" class="form-control" id="grado" name="grado" value="0" placeholder="" required="" readonly>
                                    </div>
                                </div>
                            </div>

                            @if (Auth::user()->role == 'A')
                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <h5>Datos de Acceso <span class="text-muted">(Opcional)</span></h5>
                                </div>
                                <hr>
                                <div class="col-sm-6 col-12 px-1">
                                    <!-- Form Field Start -->
                                    <div class="mb-3">
                                        <label for="" class="form-label">Usuario</label>
                                        <input type="email" class="form-control" id="email" name="email" value="" placeholder="">
                                    </div>
                                </div>

                                <div class="col-sm-6 col-12 px-1">
                                    <!-- Change Password -->
                                    <div class="mb-3">
                                        <label for="" class="form-label col-12">Contraseña</label>
                                        <input type="password" id="password" class="form-control" name="password" value="">
                                    </div>
                                </div>

                                <div class="col-sm-6 col-12 mb-3 px-1">
                                    <div class="m-0">
                                        <label class="form-label d-flex">Rol</label>
                                        <select class="select-rol-add js-states form-control" title="Seleccione el Rol"
                                            data-live-search="true" name="role" id="role">
                                            <option value="">Seleccionar</option>
                                            <option value="C">C</option>
                                            <option value="R">R</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Agregar</button>
                        </div>
                    </div>
                </form>

                <form action="{{route('gestion.unidades.store')}}" method="post">
                    @csrf
                    <div id="section-unidades">
                        <div class="row">
                            <div class="col-sm-12 col-12 mb-3">
                                <label for="" class="form-label">Nueva Unidad</label>
                                <input type="text" class="form-control" id="descrip" name="descrip" placeholder="" required="" oninput="this.value = this.value.toUpperCase()">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Agregar</button>
                        </div>
                    </div>
                </form>

                <form action="{{route('gestion.categorias.store')}}" method="post">
                    @csrf
                    <div id="section-categorias">
                        <div class="row" id="row-categorias">
                            <label for="" class="form-label col-sm-8 col-12">Nueva Categoria</label>
                            <label for="" class="form-label col-sm-2 col-12">Sigla</label>

                            <div class="col-sm-8 col-12 mb-3 p-1">
                                <input type="text" class="form-control" id="descrip" name="descrip[]" placeholder="" required="" oninput="this.value = this.value.toUpperCase()">
                            </div>

                            <div class="col-sm-2 col-12 mb-3 p-1">
                                <input type="text" class="form-control" id="sigla" name="sigla[]" placeholder="" required="" oninput="this.value = this.value.toUpperCase()">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 col-6 mb-3 p-1">
                                <button type="button" class="btn btn-info" id="btn-add-categoria"><i class="bi bi-plus-square"></i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-12 mb-3">
                                <div class="m-0">
                                    <label class="form-label d-flex">Unidad Administrativa</label>
                                    <select class="select-unidad-add2 js-states form-control select-single" title="Seleccione la Unidad Administrativa"
                                        data-live-search="true" name="unidades_id" id="unidades_id" required="">
                                        <option value="0">Seleccionar</option>
                                        @foreach ($unidades as $unidad)
                                        <option value="{{$unidad->id}}">{{$unidad->id}}. {{$unidad->descrip}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success btn-add-categoria" disabled>Agregar</button>
                        </div>
                    </div>
                </form>

                <form action="{{route('gestion.institucions.store')}}" method="post">
                    @csrf
                    <div id="section-instituciones">
                        <div class="row">
                            <div class="col-sm-12 col-12 mb-3">
                                <label for="" class="form-label">Nueva Institución</label>
                                <input type="text" class="form-control" id="descrip" name="descrip" placeholder="" required="" oninput="this.value = this.value.toUpperCase()">
                            </div>
                            <div class="col-sm-12 col-12 mb-3">
                                <label for="" class="form-label">Ciudad</label>
                                <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="" required="" oninput="this.value = this.value.toUpperCase()">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Agregar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>