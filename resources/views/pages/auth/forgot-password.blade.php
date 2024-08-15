@extends('layouts.auth')
@section('content')

    <div class="w-325px w-sm-475px pb-5 ">
        <div class="card h-md-100" dir="ltr">
            <div class="card-body d-flex flex-column flex-center">
                <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate"
                      action="{{ route('forgot-password::send-email') }}" method="post">
                    @csrf
                    <div class="text-center mb-11">
                        <h1 class="text-gray-900 fw-bolder mb-3">
                            {{ trans('auth.reset_password') }}
                        </h1>
                        <div class="text-gray-500 fw-semibold fs-6">
                            {{ trans('auth.reset_password_send_instructions') }}
                        </div>
                    </div>
                    <x-form.input col="mt-5 mb-5" name="email" :label="trans('auth.email')"/>

                    <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">{{ trans('auth.reset_password_send_button') }}</span>
                            <span class="indicator-progress"> ... <span
                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <a href="{{ route('login::view') }}" class="mx-2 btn btn-light">
                            <span class="indicator-label">{{ trans('app.cancel') }}</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
