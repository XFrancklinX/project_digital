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

$unidades = Unidad::all();
@endphp

<!-- Modal 2 -->
<div class="modal fade" id="modal-edit-gestion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <div id="tittle-categorias">
                    <h5 class="modal-title" id="staticBackdropLabel">Actualizar Categorias #{{$categorias->id}}</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('gestion.categorias.update')}}" method="post">
                    @csrf
                    <div id="section-categorias">
                        <div class="row" id="row-categorias">
                            <input type="number" id="id" name="id" value="{{$categorias->id}}" hidden readonly>
                            <label for="" class="form-label col-sm-8 col-12">Nueva Categoria</label>
                            <label for="" class="form-label col-sm-2 col-12">Sigla</label>

                            <div class="col-sm-8 col-12 mb-3 p-1">
                                <input type="text" class="form-control" id="descrip" name="descrip" value="{{$categorias->descrip}}" placeholder="" required="" oninput="this.value = this.value.toUpperCase()">
                            </div>

                            <div class="col-sm-2 col-12 mb-3 p-1">
                                <input type="text" class="form-control" id="sigla" name="sigla" value="{{$categorias->sigla}}" placeholder="" required="" oninput="this.value = this.value.toUpperCase()">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-12 mb-3">
                                <div class="m-0">
                                    <label class="form-label d-flex">Unidad Administrativa</label>
                                    <select class="select-unidad-edit3 js-states form-control select-single" title="Seleccione la Unidad Administrativa"
                                        data-live-search="true" name="unidades_id" id="unidades_id" required="">
                                        <option value="{{$categorias->unidades_id}}">{{Unidad::find($categorias->unidades_id)->id}}. {{Unidad::find($categorias->unidades_id)->descrip}}</option>
                                        @foreach ($unidades as $unidad)
                                        <option value="{{$unidad->id}}">{{$unidad->id}}. {{$unidad->descrip}}</option>
                                        @endforeach
                                    </select>
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