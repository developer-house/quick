@extends('quick::templates.layout.app')

@section('content')

    <div class="card card-filter">

        <div class="card-header">
            <div class="title">
                <h1>Usuarios</h1>
                <h2>*** **** *** ***</h2>
            </div>
            <div class="options">
                <button class="btn btn-option" data-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                </button>

                <div class="dropdown-menu dropdown-menu-right slideInUp">
                    <a class="dropdown-item" href="{{ route('users.create') }}">
                        <i data-feather="user-plus"></i>
                        <span class="text-truncate pr-2" title="Seguridad">Nuevo usuario</span>
                    </a>
                    <a class="dropdown-item" id="search" href="javascript:void(0);">
                        <i data-feather="search"></i>
                        <span class="text-truncate pr-2" title="Buscar">Buscar</span>
                    </a>
                </div>


            </div>
        </div>

        <div class="card-body" id="filter">

            <form class="custom-form" method="GET" action="{{ route('users.index') }}">

                <div class="form-group row mb-0">

                    <div class="col-10 col-sm-11 col-md-11 col-lg-10 col-xl-11 pr-md-0 pr-lg-0 pr-xl-0">
                        <label for="search" class="d-none"></label>
                        <input class="form-control" id="search" name="search" placeholder="Busca por documento, apellidos o nombres" type="text" value="{{ Request::get('search') }}">
                    </div>

                    <div class="col-2 col-sm-1 col-md-1 col-lg-2 col-xl-1 col-btn-filter d-flex justify-content-center">
                        <button class="btn btn-filter" type="submit">
                            <i data-feather="filter"></i>
                        </button>
                    </div>

                </div>

            </form>
        </div>

        <div class="card-footer">
            <label for="">La consulta no deben superar los 30 días entre ellas</label>
        </div>


    </div>


@stop