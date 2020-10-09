@extends('quick::templates.layout.app')

@section('content')

    <div class="card card-filter">
        <div class="card-header">
            <div class="title">
                <h1>Crear usuario</h1>
                <h2>*** **** *** ***</h2>
            </div>
        </div>
    </div>

    <form class="custom-form" action="{{ route('users.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-12 col-md-4">
                <div class="card card-form">
                    <div class="card-header">
                        <h1 class="card-title">Foto de perfil de usuario</h1>
                    </div>
                    <div class="card-body">
                        <div class="text-center w-100 justify-content-center d-flex">
                            <div class="picture">
                                <img class="img-fluid" src="https://www.flaticon.es/premium-icon/icons/svg/2105/2105556.svg" alt="Imagen">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <label>Elija una foto</label>
                        <div class="custom-file">
                            <input name="photo" type="file" class="custom-file-input">
                            <label class="custom-file-label">Seleccionar archivo</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-8">
                <div class="card card-form">
                    <div class="card-header">
                        <h1 class="card-title">Información personal del usuario</h1>
                    </div>
                    <div class="card-body">
                        <div class="form-row">

                            <div class="col-12 col-md-4">
                                <label class="text-truncate" for="type_dni">Documento de identificación</label>
                                <div class="form-row">
                                    <div class="col-5 mb-0">
                                        <select class="form-control" required name="type_dni" id="type_dni">
                                            <option value="4">C.C.</option>
                                            <option value="5">C.E.</option>
                                            <option value="6">T.I.</option>
                                        </select>
                                    </div>
                                    <div class="col-7 mb-0">
                                        <input class="form-control" required name="dni" type="number" id="type_dni">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <label for="names">Nombres</label>
                                <input class="form-control" required name="names" id="names" type="text">
                            </div>

                            <div class="col-12 col-md-4">
                                <label for="surnames">Apellidos</label>
                                <input class="form-control" required name="surnames" id="surnames" type="text">
                            </div>

                            <div class="col-12 col-md-7">
                                <label for="email">Correo electrónico</label>
                                <input class="form-control" required name="email" id="email" type="email">
                            </div>

                            <div class="col-12 col-md-5">
                                <label for="username">Usuario</label>
                                <input class="form-control" required name="username" id="username" type="text">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="gender">Genero</label>
                                <select class="form-control" required id="gender" name="gender">
                                    <option value="7">Mujer</option>
                                    <option value="8">Hombre</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="rol">Rol</label>
                                <select class="form-control" required id="rol" name="rol">
                                    <option value="">Seleccione</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-8"></div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block btn-submit">Agregar</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>






@stop