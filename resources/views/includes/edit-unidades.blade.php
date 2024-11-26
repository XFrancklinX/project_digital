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

$unidadess = Unidad::all();
@endphp

<!-- Modal 2 -->
<div class="modal fade" id="modal-edit-gestion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <div id="tittle-unidades">
                    <h5 class="modal-title" id="staticBackdropLabel">Actualizar Unidades #{{$unidades->id}}</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('gestion.unidades.update', $unidades->id)}}" method="post">
                    @csrf
                    <div id="section-unidades">
                        <div class="row">
                        <input type="number" id="id" name="id" value="{{$unidades->id}}" hidden readonly>
                            <div class="col-sm-10 col-12 mb-3">
                                <label for="" class="form-label">Unidad</label>
                                <input type="text" class="form-control" id="descrip" name="descrip" value="{{$unidades->descrip}}" placeholder="" required="" oninput="this.value = this.value.toUpperCase()">
                            </div>
                            <div class="col-sm-2 col-12 mb-3">
                                <div class="m-0">
                                    <label class="form-label d-flex">Estado</label>
                                    <select class="select-unidad-edit js-states form-control select-single" title="Seleccione la Unidad Administrativa"
                                        data-live-search="true" name="estado" id="estado" required="">
                                        <option value="{{$unidades->estado}}">{{$unidades->estado}}</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
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