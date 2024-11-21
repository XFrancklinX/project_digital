<!-- Offcanvas Right -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="add-persona" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Agregar Persona</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row">
            <div class="col-sm-12 col-12 mb-3">
                <div class="m-0">
                    <label class="form-label d-flex">Persona</label>
                    <select class="select-persona js-states form-control select-single" title="Seleccione la Persona"
                        data-live-search="true" required="">
                        @foreach ($personas as $persona)
                        <option value="{{$persona->id}}">{{$persona->nombres}} {{$persona->apell_pat}} {{$persona->apell_mat}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>