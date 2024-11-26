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
                <div id="tittle-instituciones">
                    <h5 class="modal-title" id="staticBackdropLabel">Actualizar Instituciones #{{$institucions->id}}</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('gestion.institucions.update')}}" method="post">
                    @csrf
                    <div id="section-instituciones">
                        <div class="row">
                            <input type="number" id="id" name="id" value="{{$institucions->id}}" hidden readonly>
                            <div class="col-sm-12 col-12 mb-3">
                                <label for="" class="form-label">Nueva Institución</label>
                                <input type="text" class="form-control" id="descrip" name="descrip" value="{{$institucions->descrip}}" placeholder="" required="" oninput="this.value = this.value.toUpperCase()">
                            </div>
                            <div class="col-sm-12 col-12 mb-3">
                                <label for="" class="form-label">Ciudad</label>
                                <input type="text" class="form-control" id="ciudad" name="ciudad" value="{{$institucions->ciudad}}" placeholder="" required="" oninput="this.value = this.value.toUpperCase()">
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