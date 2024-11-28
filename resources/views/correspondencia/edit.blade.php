@php
use App\Models\Persona;
use App\Models\Unidad;
use App\Models\Categoria;
use App\Models\Institucion;
use App\Models\Documento;
use App\Models\User;
use App\Models\Cargo;
use Illuminate\Support\Facades\File;

$unidades = Unidad::all();
$categorias = Categoria::all();
$personas = Persona::all();
$instituciones = Institucion::all();
$cargos = Cargo::all();
@endphp
<!-- Modal 2 -->
<div class="modal fade" id="modal-edit-correspondencia" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Formulario de Edición #{{$documentos->id}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('correspondencia.update')}}" method="POST" enctype="multipart/form-data" id="form-add">
                @csrf
                <input type="number" name="id" id="id" value="{{$documentos->id}}" hidden readonly>
                <div class="modal-body">
                    <!-- Row start -->
                    <div class="row">
                        <div class="col-sm-6 col-12 mb-3">
                            <label for="" class="form-label">Fecha de Registro</label>
                            <input type="date" class="form-control" id="fecha_reg" name="fecha_reg" value="{{$documentos->fecha_reg}}" placeholder="" required="">
                        </div>
                        <div class="col-sm-6 col-12 mb-3">
                            <label for="" class="form-label">Codigo</label>
                            <input type="text" class="form-control" id="code" name="code" placeholder="" value="{{$documentos->codigo}}" readonly required="">
                        </div>
                        <div class="col-sm-12 col-12 mb-3">
                            <label for="" class="form-label">Nº de CITE</label>
                            <input type="text" class="form-control" id="identificador" name="identificador" placeholder="" value="{{$documentos->identificador}}" required="" oninput="this.value = this.value.toUpperCase()">
                        </div>
                        <div class="col-sm-12 col-12 mb-3">
                            <label for="" class="form-label">Referencia</label>
                            <input type="text" class="form-control" id="referencia" name="referencia" placeholder="" value="{{$documentos->referencia}}" required="" oninput="this.value = this.value.toUpperCase()">
                        </div>

                        <div class="col-sm-6 col-12 mb-3">
                            <div class="m-0">
                                <label class="form-label d-flex">Unidad Administrativa</label>
                                <select class="select-unidad js-states form-control select-single" title="Seleccione la Unidad Administrativa"
                                    data-live-search="true" name="unidades_id" id="unidades_id" required="" disabled>
                                    <option value="{{$documentos->unidades_id}}">{{Unidad::find($documentos->unidades_id)->id}}. {{Unidad::find($documentos->unidades_id)->descrip}}</option>
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
                                    data-live-search="true" name="categorias_id" id="categorias_id" required="" disabled>
                                    <option value="{{$documentos->categorias_id}}">{{Categoria::find($documentos->categorias_id)->id}}. {{Categoria::find($documentos->categorias_id)->descrip}}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="form-label d-flex">Tipo de Documento</label>
                        <div class="col-6 d-xxl-block d-xl-block d-sm-block align-self-center">
                            @if ($documentos->tipo_doc == 'INTERNA')
                            <div class="form-check col-12">
                                <input class="form-check-input" type="radio" name="radioDocumento" id="radioInterna" value="INTERNA" required="" checked readonly>
                                <label class="form-check-label" for="radioInterna">Interna</label>
                            </div>

                            <div class="form-check col-12">
                                <input class="form-check-input" type="radio" name="radioDocumento" id="radioExterna" value="EXTERNA" required="" readonly>
                                <label class="form-check-label" for="radioExterna">Externa</label>
                            </div>
                            @else
                            <div class="form-check col-12">
                                <input class="form-check-input" type="radio" name="radioDocumento" id="radioInterna" value="INTERNA" required="" readonly>
                                <label class="form-check-label" for="radioInterna">Interna</label>
                            </div>

                            <div class="form-check col-12">
                                <input class="form-check-input" type="radio" name="radioDocumento" id="radioExterna" value="EXTERNA" required="" checked readonly>
                                <label class="form-check-label" for="radioExterna">Externa</label>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-10 col-12 mb-3">
                            <div class="m-0">
                                <label class="form-label d-flex">Persona</label>
                                <select class="select-persona js-states form-control select-single" title="Seleccione la Persona"
                                    data-live-search="true" name="personas_id" id="personas_id" required="" disabled>
                                    <option value="{{$documentos->personas_id}}">{{$documentos->personas_id}}. {{Persona::find($documentos->personas_id)->nombres}} {{Persona::find($documentos->personas_id)->apell_pat}} {{Persona::find($documentos->personas_id)->apell_mat}}</option>
                                    @foreach ($personas as $persona)
                                    <option value="{{$persona->id}}">{{$persona->id}}. {{$persona->nombres}} {{$persona->apell_pat}} {{$persona->apell_mat}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-sm-10 col-10 mb-3">
                            <label for="" class="form-label">Cargo</label>
                            <input type="text" class="form-control" id="cargo" name="cargo" placeholder="" value="{{$documentos->cargo}}" oninput="this.value = this.value.toUpperCase()">
                        </div>
                        <div class="col-sm-10 col-12 mb-3">
                            <div class="m-0">
                                <label class="form-label d-flex">Institución</label>
                                <select class="select-institucion js-states form-control select-single" title="Seleccione la Unidad Administrativa"
                                    data-live-search="true" name="instituciones_id" id="instituciones_id" required="" disabled>
                                    <option value="{{$documentos->institucions_id}}">{{Institucion::find($documentos->institucions_id)->id}}. {{Institucion::find($documentos->institucions_id)->descrip}}</option>
                                    @foreach ($instituciones as $institucion)
                                    <option value="{{$institucion->id}}">{{$institucion->id}}. {{$institucion->descrip}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        

                        <div class="col-sm-4 col-12 mb-3">
                            <label for="" class="form-label col-12">Archivo(s)</label>
                            <button class="btn-primary rounded" type="button">
                                <input class="input" type="file" name="file[]" id="file" placeholder="" accept=".pdf ,.doc ,.docx" required="">
                                <i class="bi bi-upload"></i> Cargar
                            </button>
                        </div>

                        <div class="col-sm-8 col-12 mb-3 preview align-self-center">
                            <label for="" class="filepdf">
                                @php
                                $files = explode('/', $documentos->archivo);
                                @endphp

                                @foreach ($files as $file)
                                @if ($file != null)
                                <a href="{{asset('documents/'.$file)}}" target="_blank" class="btn btn-sm btn-success rounded">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                </a>
                                <span>{{$file}}</span>
                                @endif
                                @endforeach
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success addCorrespondencia">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#file').change(function() {
            var files = $(this).prop('files');
            if (files.length > 0) {
                var fileNames = '';

                for (var i = 0; i < files.length; i++) {
                    fileNames += 'Archivo ' + (i + 1) + ': ' + files[i].name + '<br>';
                }
                $('.filepdf').html('Archivos Subidos Exitosamente <br>' + fileNames);
            } else {
                $('.filepdf').text('No se subió ningún archivo');
            }
        });
    });
</script>