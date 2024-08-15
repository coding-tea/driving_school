@extends('layouts.auth')
@section('content')
    <div class="w-325px w-sm-475px pb-5 ">
        <div class="card h-md-100" dir="ltr">
            <div class="card-body d-flex flex-column flex-center">
                <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate"
                      action="{{ route('reset-password::reset') }}" method="post">
                    @csrf
                    <div class="text-center mb-11">
                        <h1 class="text-gray-900 fw-bolder mb-3">
                            {{ trans('auth.reset_password') }}
                        </h1>

                    </div>
                    <input type="hidden" name="token" value="{{ $token }}">
                    <x-form.input readonly  :defaut-value="$email" col="mt-5 mb-8  " class=" form-control-solid" name="email" :label="trans('auth.email')" />
                    <x-form.input col="mt-5 mb-8" type="password" name="password" :label="trans('auth.password')" />
                    <x-form.input col="mt-5 mb-8"
                                  type="password"
                                  name="password_confirmation"
                                  :label="trans('auth.password_confirm')" />
                    <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                            <span class="indicator-label">{{ trans('auth.reset_password') }}</span>
                            <span class="indicator-progress"> ... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <a href="{{ route('login::view') }}" class="mx-2 btn btn-light">
                            <span class="indicator-label">{{ trans('app.cancel') }}</span>
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>



    <div class="pb-5">
            <span id="timer" data-date="{{ $expires_at }}">

            </span>
    </div>
@endsection
@vite(pageJs('auth.resetPassword'))
