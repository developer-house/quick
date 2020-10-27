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
                        <form action="{{ route('quick.login.post') }}" method="post" autocomplete="off">
                            @csrf

                            <div class="text-center">
                                <div class="mb-5">
                                    <h1 class="title">{{ trans('quick::text.sign-in') }}</h1>
                                </div>
                            </div>

                            @if (config('quick.login.type') === 'email')
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
                            @else
                                <div class="js-form-message form-group mb-4">
                                    <label class="input-label" for="username">{{ trans('quick::text.username') }}</label>
                                    <input type="text"
                                           class="form-control form-control-lg {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                           name="username"
                                           id="username"
                                           value="{{ old('username') }}"
                                           placeholder="Username"
                                           required>
                                    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            @endif


                            <div class="js-form-message form-group mb-4">
                                <label class="input-label" for="password">{{ trans('quick::text.password') }}</label>
                                <input type="password"
                                       class="form-control
                                        form-control-lg {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                       name="password"
                                       id="password"
                                       placeholder="*****************"
                                       required>
                                {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                            <div class="form-group mb-4">
                                <a href="{{ route('quick.password.request') }}">
                                    <label class="font-size-sm text-muted cursor-pointer" for="checkbox">{{ trans('quick::text.reset.password') }}</label>
                                </a>
                            </div>

                            <button type="submit" class="btn btn-lg btn-block btn-primary">{{ trans('quick::text.sign-in') }}</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop