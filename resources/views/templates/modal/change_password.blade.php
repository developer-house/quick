<div class="modal modal-form fade" id="change_password" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal" role="document">
        <div class="modal-content">
            <form class="custom-form" action="{{ route('user.security.password') }}" method="post" class="form-submit" autocomplete="off">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Cambiar contraseña</h5>
                </div>

                <div class="modal-body">


                    <div class="form-row">

                        <div class="col-12">
                            <label>Contraseña actual</label>
                            {!! Form::password('current_password', ['class' => 'form-control', 'required']) !!}
                        </div>

                        <div class="col-6">
                            <label>Contraseña nueva</label>
                            {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
                        </div>

                        <div class="col-6">
                            <label>Confirmar contraseña</label>
                            {!! Form::password('password_confirmation', ['class' => 'form-control', 'required']) !!}
                        </div>

                    </div>
                </div>

                <div class="modal-footer">

                    <div class="form-row w-100">

                        <div class="col-6 pl-0">
                            <button type="button" class="btn btn-outline-secondary btn-block" data-dismiss="modal">Cancelar</button>
                        </div>

                        <div class="col-6 pr-0">
                            <button type="submit" class="btn btn-primary btn-block btn-submit">Guardar cambios</button>
                        </div>

                    </div>

                </div>

            </form>
        </div>

    </div>
</div>



