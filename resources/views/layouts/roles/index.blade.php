@extends('quick::templates.layout.app')

@section('content')

    <div class="card card-filter">

        <div class="card-header">
            <div class="title">
                <h1>Roles</h1>
                <h2>*** **** *** ***</h2>
            </div>
            <div class="options">
                <button class="btn btn-option" data-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                </button>

                <div class="dropdown-menu dropdown-menu-right slideInUp">

                    @can('role.create')
                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#create">
                            <i data-feather="tag"></i>
                            <span class="text-truncate pr-2" title="Seguridad">Nuevo rol</span>
                        </a>

                        @push('modal')
                            @include('quick::layouts.roles.create')
                        @endpush

                    @endcan

                    <a class="dropdown-item" id="search" href="javascript:void(0);">
                        <i data-feather="search"></i>
                        <span class="text-truncate pr-2" title="Buscar">Buscar</span>
                    </a>
                </div>

            </div>
        </div>

        <div class="card-body" id="filter">

            <form class="custom-form" method="GET" action="{{ route('role.index') }}" autocomplete="off">

                <div class="form-group row mb-0">

                    <div class="col-10 col-sm-11 col-md-11 col-lg-10 col-xl-11 pr-md-0 pr-lg-0 pr-xl-0">
                        <label for="search" class="d-none"></label>
                        <input class="form-control" id="search" name="search" placeholder="Busca por nombre del valor" type="text" value="{{ Request::get('search') }}">
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

    <div class="card card-table">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">GUARD</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->guard_name }}</td>
                                <td class="text-right">
                                    <div class="button custom-dropdown-area dropdown">
                                        <button type="button" class="btn btn-outline-secondary skin" id="dropdownMenu" data-toggle="dropdown">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right slideInUp" aria-labelledby="dropdownMenu">
                                            @can('role.show')
                                                <a class="dropdown-item" href="{{ route('role.show', [$role->id]) }}">
                                                    <i data-feather="sliders"></i>
                                                    <span class="text-truncate pr-2">Permisos</span>
                                                </a>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>


    <div class="pagination d-flex justify-content-end pt-2">
        {!! $roles->appends(request()->input())->links(); !!}
    </div>





@stop

