@extends('quick::templates.layout.app')

@section('content')

    <div class="card card-filter">

        <div class="card-header">
            <div class="title">
                <h1>{{ $role->name }}</h1>
                <h2>Permisos</h2>
            </div>

            <div class="options">
                <button class="btn btn-option" data-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                </button>

                <div class="dropdown-menu dropdown-menu-right slideInUp">
                    <a class="dropdown-item" id="search" href="javascript:void(0);">
                        <i data-feather="search"></i>
                        <span class="text-truncate pr-2" title="Buscar">Buscar</span>
                    </a>
                </div>

            </div>
        </div>

        <div class="card-body" id="filter">

            <form class="custom-form" method="GET" action="{{ route('role.show', $role->id) }}" autocomplete="off">

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
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permits as $permit)
                            <tr>
                                <td>{{ $permit->id }}</td>
                                <td>
                                    <div class="d-grid">
                                        <span>{{ $permit->name }}</span>
                                        <span class="f-10">{{ $permit->description }}</span>
                                    </div>
                                </td>
                                <td class="w-20p">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox"
                                               class="custom-control-input"
                                               name="permission"
                                               id="permission-{{ $permit->id }}"
                                               value="{{ $permit->id }}" {{ ($role->hasPermissionTo($permit->name) ? 'checked' : '') }}>
                                        <label class="custom-control-label" for="permission-{{ $permit->id }}"></label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@stop


@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function (event) {


            $('input:checkbox').change(
                function () {

                    let type       = 0;
                    let permission = '';

                    if ($(this).is(':checked')) {
                        type       = 1;
                        permission = this.value;
                    } else {
                        type       = 2;
                        permission = this.value;
                    }

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url       : '{{ route('assign.permission.to.role') }}',
                        type      : 'POST',
                        data      : {
                            role      : '{{ $role->id }}',
                            type      : type,
                            permission: permission
                        },
                        beforeSend: function () {

                        },

                        success: function (data) {

                            if (data.state === 1) {

                                window.toastr.success(data.msg);

                            } else if (data.state === 2 || data.state === 3) {

                                window.toastr.error(data.msg);

                                setInterval(function () {
                                    window.location.reload();
                                }, 1000);

                            }
                        },

                        error: function (data) {

                            console.log(data);

                            console.log(data['responseJSON'].error);

                            window.toastr.error(data['responseJSON'].error);

                            setInterval(function () {
                                //window.location.reload();
                            }, 1000);

                        },

                    });


                });
        });
    </script>
@endpush
