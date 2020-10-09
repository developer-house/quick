@extends('quick::templates.auth.app')


@section('content')
    <div class="container py-5 py-sm-7">
        <a class="d-flex justify-content-center mb-5 logo" href="{{ route('quick.login.from') }}">
            <img class="z-index-2" src="{{ config('quick.login.logo') }}" alt="Logo">
        </a>

        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="card card-lg mb-5">
                    <div class="card-body">
                        <form action="{{ route('quick.password.email') }}" method="post" autocomplete="off">
                            @csrf

                            <div class="text-center">
                                <div class="mb-5">
                                    <h1 class="title">{{ trans('quick::text.reset.password') }}</h1>
                                </div>
                            </div>

                            <div class="js-form-message form-group mb-4">
                                <label class="input-label" for="email">{{ trans('quick::text.email') }}</label>
                                <input type="email"
                                       class="form-control form-control-lg {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                       name="email"
                                       id="email"
                                       value="{{ old('email') }}"
                                       placeholder="email@address.com"
                                       required>
                                {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                            </div>


                            <div class="form-group mb-4">
                                <a href="{{ route('quick.login.from') }}">
                                    <label class="font-size-sm text-muted cursor-pointer">{{ trans('quick::text.sign-in') }}</label>
                                </a>

                            </div>

                            <button type="submit" class="btn btn-lg btn-block btn-primary">{{ trans('quick::text.reset') }}</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop