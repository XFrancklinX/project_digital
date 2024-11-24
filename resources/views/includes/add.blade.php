<!-- Modal 2 -->
<div class="modal fade" id="modal-add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Formulario de Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('correspondencia.store')}}" method="POST" enctype="multipart/form-data" id="form-add" name="form_add">
                @csrf
                <div class="modal-body">
                    <!-- Row start -->
                    <div class="row">
                        <div class="col-sm-6 col-12 mb-3">
                            <label for="" class="form-label">Fecha de Registro</label>
                            <input type="date" class="form-control" id="fecha_reg" name="fecha_reg" placeholder="" >
                        </div>
                        <div class="col-sm-6 col-12 mb-3">
                            <label for="" class="form-label">Codigo</label>
                            <input type="text" class="form-control" id="code" name="code" placeholder="" value="-----" readonly >
                        </div>
                        <div class="col-sm-12 col-12 mb-3">
                            <label for="" class="form-label">Nº de CITE</label>
                            <input type="text" class="form-control" id="identificador" name="identificador" placeholder=""  oninput="this.value = this.value.toUpperCase()">
                        </div>
                        <div class="col-sm-12 col-12 mb-3">
                            <label for="" class="form-label">Referencia</label>
                            <input type="text" class="form-control" id="referencia" name="referencia" placeholder=""  oninput="this.value = this.value.toUpperCase()">
                        </div>

                        <div class="col-sm-6 col-12 mb-3">
                            <div class="m-0">
                                <label class="form-label d-flex">Unidad Administrativa</label>
                                <select class="select-unidad js-states form-control select-single" title="Seleccione la Unidad Administrativa"
                                    data-live-search="true" name="unidades_id" id="unidades_id" >
                                    <option value="0">Seleccionar</option>
                                    @foreach ($unidades as $unidad)
                                    <option value="{{$unidad->id}}">{{$unidad->id}}. {{$unidad->descrip}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 mb-3">
                            <div class="m-0">
                                <label class="form-label d-flex">Categoría</label>
                                <select class="select-categoria js-states form-control select-single" title="Seleccione El tipo de Documento"
                                    data-live-search="true" name="categorias_id" id="categorias_id" >
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="form-label d-flex">Tipo de Documento</label>
                        <div class="col-6 d-xxl-block d-xl-block d-sm-block align-self-center">
                            <div class="form-check col-12">
                                <input class="form-check-input" type="radio" name="radioDocumento" id="radioInterna" value="INTERNA" >
                                <label class="form-check-label" for="radioInterna">Interna</label>
                            </div>
                            <div class="form-check col-12">
                                <input class="form-check-input" type="radio" name="radioDocumento" id="radioExterna" value="EXTERNA" >
                                <label class="form-check-label" for="radioExterna">Externa</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-10 col-12 mb-3">
                            <div class="m-0">
                                <label class="form-label d-flex">Persona</label>
                                <select class="select-persona js-states form-control select-single" title="Seleccione la Persona"
                                    data-live-search="true" name="personas_id" id="personas_id" >
                                    <option value="0">Seleccionar</option>
                                    @foreach ($personas as $persona)
                                    <option value="{{$persona->id}}">{{$persona->id}}. {{$persona->nombres}} {{$persona->apell_pat}} {{$persona->apell_mat}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2 col-12 mb-3">
                            <label for="" class="form-label col-12 text-center">Agregar</label>
                            <!-- Offcanvas Right Personas-->
                            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#add-persona" aria-controls="offcanvasRight">
                                <i class="bi bi-plus-square"></i>
                            </button>
                        </div>
                        <div class="col-sm-10 col-10 mb-3">
                            <label for="" class="form-label">Cargo</label>
                            <input type="text" class="form-control" id="cargo" name="cargo" placeholder=""  oninput="this.value = this.value.toUpperCase()">
                        </div>
                        <div class="col-sm-10 col-12 mb-3">
                            <div class="m-0">
                                <label class="form-label d-flex">Institución</label>
                                <select class="select-institucion js-states form-control select-single" title="Seleccione la Unidad Administrativa"
                                    data-live-search="true" name="instituciones_id" id="instituciones_id" >
                                    <option value="0">Seleccionar</option>
                                    @foreach ($instituciones as $institucion)
                                    <option value="{{$institucion->id}}">{{$institucion->id}}. {{$institucion->descrip}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2 col-12 mb-3">
                            <label for="" class="form-label col-12 text-center">Agregar</label>
                            <!-- Offcanvas Right Instituciones-->
                            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#add-institucion" aria-controls="offcanvasRight">
                                <i class="bi bi-plus-square"></i>
                            </button>
                        </div>

                        <div class="col-sm-4 col-12 mb-3">
                            <label for="" class="form-label col-12">Archivo(s)</label>
                            <button class="btn-primary rounded" type="button">
                                <input class="input" type="file" name="file[]" id="file" placeholder="" accept=".pdf ,.doc ,.docx"  multiple>
                                <i class="bi bi-upload"></i> Cargar
                            </button>
                        </div>

                        <div class="col-sm-8 col-12 mb-3 preview align-self-center">
                            <label for="" class="filepdf">
                                <span>No se subió ningún archivo</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success addCorrespondencia">Guardar</button>
                </div>
            </form>
            @include('includes.add-persona')
            @include('includes.add-institucion')
        </div>
    </div>
</div>