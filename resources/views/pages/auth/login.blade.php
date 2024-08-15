@extends('layouts.auth')
@section('content')

    <div class="w-325px w-sm-475px pb-5 ">
        <div class="card h-md-100" dir="ltr">
            <div class="card-body d-flex flex-column flex-center">
                <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate"
                      action="{{ route('login::check') }}" method="post">
                    @csrf
                    <div class="text-center mb-11">
                        <h1 class="text-gray-900 fw-bolder mb-3">
                            {{ trans('auth.log_in') }}
                        </h1>

                    </div>

                    <x-form.input  col="mt-5" name="login" :label="trans('app.cin').' (test) '"/>
                    <div class="fv-row mt-5" data-kt-password-meter="true">

                        <div class="mb-1">

                            <label class="form-label fw-semibold fs-6 mb-2">
                                {{ trans('app.password') }} (test)
                            </label>

                            <div class="position-relative mb-3">
                                <input class="form-control form-control-lg form-control"
                                       type="password"  placeholder="" name="password" autocomplete="off"/>


                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                      data-kt-password-meter-control="visibility">
                    <i class="ki-duotone ki-eye-slash fs-1"><span class="path1"></span><span class="path2"></span><span
                            class="path3"></span><span class="path4"></span></i>
                    <i class="ki-duotone ki-eye d-none fs-1"><span class="path1"></span><span class="path2"></span><span
                            class="path3"></span></i>
            </span>

                            </div>

                        </div>


                        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mt-5 mb-8">
                            <label class="form-check form-check-custom form-check-inline form-check-solid me-5">
                                <input class="form-check-input" name="remember_me" checked type="checkbox"/>
                                <span class="fw-semibold ps-2 fs-6">
                    {{ trans('auth.remember_me') }}
                   </span>
                            </label>

                            <a href="{{ route('forgot-password::view') }}" class="link-primary">
                                {{ trans('auth.reset_password') }}
                            </a>

                        </div>
                        <div class="d-grid mb-10">
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                <span class="indicator-label">{{ trans('auth.log_in') }}</span>
                                <span class="indicator-progress"> ... <span
                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                </form>
            </div>
        </div>

    </div>

@endsection
