@extends('quick::templates.auth.app')

@section('content')
    <div class="container py-5 py-sm-7">
        <a class="d-flex justify-content-center mb-5 logo" href="{{ route('quick.login.from') }}">
            <img class="z-index-2" src="{{ config('quick.login.logo') }}" alt="Logo">
        </a>

        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="card card-lg mb-5">
                    <div class="card-body text-center">

                        <div class="mb-4">
                            <img class="avatar" src="https://htmlstream.com/front-dashboard/assets/svg/illustrations/unlock.svg" alt="Image Description">
                        </div>

                        <form action="{{ route('quick.security.verify2fa') }}" method="post" autocomplete="off">
                            @csrf

                            <div class="text-center mb-3">
                                <div>
                                    <h1 class="title">{{ trans('quick::text.2fa') }}</h1>
                                    <p class="mb-0">{{ trans('quick::text.2fa.subtitle') }}</p>
                                </div>
                            </div>

                            <div class="js-form-message form-group mb-5">
                                <label class="input-label" for="token"></label>

                                <input type="text"
                                       class="form-control form-control-lg form-control-2fa {{ $errors->has('one_time_password') ? 'is-invalid' : '' }}"
                                       name="one_time_password"
                                       id="token"
                                       value="{{ old('one_time_password') }}"
                                       placeholder="Token"
                                       required
                                       autofocus>
                                {!! $errors->first('one_time_password', '<div class="invalid-feedback">:message</div>') !!}
                            </div>


                            <button type="submit" class="btn btn-lg btn-block btn-primary">{{ trans('quick::text.2fa.check') }}</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop