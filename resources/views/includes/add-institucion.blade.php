<!-- Offcanvas Right -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="add-institucion" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Agregar Institución</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row">
            <div class="col-sm-12 col-12 mb-3">
                <div class="m-0">
                    <label class="form-label d-flex">Institucion</label>
                    <select class="select-institucion js-states form-control select-single" title="Seleccione la Institución"
                        data-live-search="true" required="">
                        @foreach ($instituciones as $institucion)
                        <option value="{{$institucion->id}}">{{$institucion->descrip}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>