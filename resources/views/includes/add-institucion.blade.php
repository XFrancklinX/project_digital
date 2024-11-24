<!-- Offcanvas Right -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="add-institucion" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Agregar Institución</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="card">
            <form action="{{route('institucions.store')}}" method="POST" enctype="multipart/form-data" id="off-add-institucions">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-12 mb-3">
                            <label for="" class="form-label">Descripción</label>
                            <input type="text" class="form-control" id="descrip" name="descrip" placeholder="" oninput="this.value = this.value.toUpperCase()">
                        </div>
                        <div class="col-sm-12 col-12 mb-3">
                            <label for="" class="form-label">Ciudad</label>
                            <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="" oninput="this.value = this.value.toUpperCase()">
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