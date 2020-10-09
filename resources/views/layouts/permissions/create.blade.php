<div class="modal modal-form fade" id="create" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal" role="document">
        <div class="modal-content">
            <form class="custom-form" action="{{ route('permission.store') }}" method="post" class="form-submit" autocomplete="off">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Crear rol</h5>
                </div>

                <div class="modal-body">


                    <div class="form-row">

                        <div class="col-12">
                            <label for="name">Nombre</label>
                            <input class="form-control" required name="name" id="name" type="text">
                        </div>

                        <div class="col-12">
                            <label for="description">Descripción</label>
                            <input class="form-control" required name="description" id="description" type="text">
                        </div>

                    </div>
                </div>

                <div class="modal-footer">

                    <div class="form-row w-100">

                        <div class="col-6 pl-0">
                            <button type="button" class="btn btn-outline-secondary btn-block" data-dismiss="modal">Cancelar</button>
                        </div>

                        <div class="col-6 pr-0">
                            <button type="submit" class="btn btn-primary btn-block btn-submit">Agregar</button>
                        </div>

                    </div>

                </div>

            </form>
        </div>

    </div>
</div>


