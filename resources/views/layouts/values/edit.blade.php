<div class="modal modal-form fade" id="edit-{{ $value->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal" role="document">
        <div class="modal-content">
            <form class="custom-form" action="{{ route('value.update', $value->id) }}" method="post" class="form-submit" autocomplete="off">
                @method('put')
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Editar valor</h5>
                </div>

                <div class="modal-body">


                    <div class="form-row">

                        <div class="col-12">
                            <label for="name">Nombre</label>
                            <input class="form-control" required name="name" id="name" type="text" value="{{ $value->name }}">
                        </div>

                        <div class="col-12">
                            <label for="description">Descripción</label>
                            <input class="form-control" required name="description" id="description" type="text" value="{{ $value->description }}">
                        </div>

                        <div class="col-12">
                            <label for="state">Estado</label>
                            <select class="form-control" required name="state" id="state">
                                <option {{ ($value->state === '1') ? 'select' : '' }} value="1">Activo</option>
                                <option {{ ($value->state === '2') ? 'select' : '' }} value="2">Inactivo</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">

                    <div class="form-row w-100">

                        <div class="col-6 pl-0">
                            <button type="button" class="btn btn-outline-secondary btn-block" data-dismiss="modal">Cancelar</button>
                        </div>

                        <div class="col-6 pr-0">
                            <button type="submit" class="btn btn-primary btn-block btn-submit">Actualizar</button>
                        </div>

                    </div>

                </div>

            </form>
        </div>

    </div>
</div>



