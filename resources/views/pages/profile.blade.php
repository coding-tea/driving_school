@extends('layouts.app')
@include('components.edition')
@section('content')




    @if($first_connection)
        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed  p-6 mb-6">
            <!--begin::Icon-->
            <i class="ki-outline ki-information fs-2tx text-warning me-4"></i>        <!--end::Icon-->

            <!--begin::Wrapper-->
            <div class="d-flex flex-stack flex-grow-1 ">
                <!--begin::Content-->
                <div class=" fw-semibold">
                    <h4 class="text-gray-900 fw-bold">{{ trans('user-management/profiles.alerts.first_connection.title') }}</h4>

                    <div class="fs-6 text-gray-700 ">
                        {{ trans('user-management/profiles.alerts.first_connection.body') }}
                        <a href="#account-security" data-kt-scroll-toggle class="fw-bold">{{ trans('user-management/profiles.alerts.first_connection.button') }}</a>
                    </div>
                </div>
                <!--end::Content-->

            </div>
            <!--end::Wrapper-->
        </div>
    @endif




    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <div class="d-flex flex-wrap flex-sm-nowrap">

                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <img
                            src="{{ stream_image_from_uploads($collaborator->image?->getPath() , ['default' => \App\Services\ImageService::DEFAULT_PERSON] ) }}"
                            alt="image">
                        <div
                            class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-primary rounded-circle border border-4 border-body h-20px w-20px"></div>
                    </div>
                </div>


                <div class="flex-grow-1">

                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">

                        <div class="d-flex flex-column">

                            <div class="d-flex align-items-center mb-2">
                                <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">
                                    {{ $collaboratorDto->fullName() }}
                                </a>

                            </div>


                            <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                <a href="#"
                                   class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                    <i class="ki-outline ki-profile-circle fs-4 me-1"></i>

                                </a>
                                <a href="#"
                                   class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                    <i class="ki-outline ki-geolocation fs-4 me-1"></i>
                                    {{$collaborator->address}}
                                </a>
                                <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary mb-2">
                                    <i class="ki-outline ki-sms fs-4"></i>
                                    {{ $collaborator->email }}
                                </a>
                            </div>

                        </div>


                        <div class="d-flex my-4">
                            <a href="#" class="btn btn-sm btn-light me-2" id="kt_user_follow_button">
                                <i class="ki-outline ki-check fs-3 d-none"></i>

                                <span class="indicator-label">
    Follow</span>


                                <span class="indicator-progress">
    Please wait...    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
</span>
                            </a>

                            <a href="#" class="btn btn-sm btn-primary me-3" data-bs-toggle="modal"
                               data-bs-target="#kt_modal_offer_a_deal">Hire Me</a>


                            <div class="me-0">
                                <button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="ki-solid ki-dots-horizontal fs-2x"></i></button>


                                <div
                                    class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
                                    data-kt-menu="true">

                                    <div class="menu-item px-3">
                                        <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                                            Payments
                                        </div>
                                    </div>


                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">
                                            Create Invoice
                                        </a>
                                    </div>


                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link flex-stack px-3">
                                            Create Payment

                                            <span class="ms-2" data-bs-toggle="tooltip"
                                                  aria-label="Specify a target name for future usage and reference"
                                                  data-bs-original-title="Specify a target name for future usage and reference"
                                                  data-kt-initialized="1">
                <i class="ki-outline ki-information fs-6"></i>            </span>
                                        </a>
                                    </div>


                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">
                                            Generate Bill
                                        </a>
                                    </div>


                                    <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                         data-kt-menu-placement="right-end">
                                        <a href="#" class="menu-link px-3">
                                            <span class="menu-title">Subscription</span>
                                            <span class="menu-arrow"></span>
                                        </a>


                                        <div class="menu-sub menu-sub-dropdown w-175px py-4">

                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">
                                                    Plans
                                                </a>
                                            </div>


                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">
                                                    Billing
                                                </a>
                                            </div>


                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">
                                                    Statements
                                                </a>
                                            </div>


                                            <div class="separator my-2"></div>


                                            <div class="menu-item px-3">
                                                <div class="menu-content px-3">

                                                    <label
                                                        class="form-check form-switch form-check-custom form-check-solid">

                                                        <input class="form-check-input w-30px h-20px" type="checkbox"
                                                               value="1" checked="checked" name="notifications">


                                                        <span class="form-check-label text-muted fs-6">
                            Recuring
                        </span>

                                                    </label>

                                                </div>
                                            </div>

                                        </div>

                                    </div>


                                    <div class="menu-item px-3 my-1">
                                        <a href="#" class="menu-link px-3">
                                            Settings
                                        </a>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="d-flex flex-wrap flex-stack">

                        <div class="d-flex flex-column flex-grow-1 pe-8">

                            <div class="d-flex flex-wrap">

                                <div
                                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">

                                    <div class="d-flex align-items-center">
                                        <i class="ki-outline ki-arrow-up fs-3 text-success me-2"></i>
                                        <div class="fs-2 fw-bold counted" data-kt-countup="true"
                                             data-kt-countup-value="4500" data-kt-countup-prefix="$"
                                             data-kt-initialized="1">$4,500
                                        </div>
                                    </div>


                                    <div class="fw-semibold fs-6 text-gray-500">Earnings</div>

                                </div>


                                <div
                                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">

                                    <div class="d-flex align-items-center">
                                        <i class="ki-outline ki-arrow-down fs-3 text-danger me-2"></i>
                                        <div class="fs-2 fw-bold counted" data-kt-countup="true"
                                             data-kt-countup-value="80" data-kt-initialized="1">80
                                        </div>
                                    </div>


                                    <div class="fw-semibold fs-6 text-gray-500">Projects</div>

                                </div>


                                <div
                                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">

                                    <div class="d-flex align-items-center">
                                        <i class="ki-outline ki-arrow-up fs-3 text-success me-2"></i>
                                        <div class="fs-2 fw-bold counted" data-kt-countup="true"
                                             data-kt-countup-value="60" data-kt-countup-prefix="%"
                                             data-kt-initialized="1">%60
                                        </div>
                                    </div>


                                    <div class="fw-semibold fs-6 text-gray-500">Success Rate</div>

                                </div>

                            </div>

                        </div>


                        <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                            <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                <span class="fw-semibold fs-6 text-gray-500">Profile Compleation</span>
                                <span class="fw-bold fs-6">50%</span>
                            </div>

                            <div class="h-5px mx-3 w-100 bg-light mb-3">
                                <div class="bg-success rounded h-5px" role="progressbar" style="width: 50%;"
                                     aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <ul class="nav nav-stretch nav-pills nav-pills-custom d-flex mt-3" role="tablist">

                <li class="nav-item p-0 ms-0 me-8 " role="presentation">
                    <a class="nav-link btn btn-color-muted px-0   " data-bs-toggle="tab"
                       href="#collaborator_overview" aria-selected="false" role="tab" tabindex="-1">
                        <span class="nav-text fw-semibold fs-4 mb-3">
                            {{ trans("app.overview") }}
                            </span>
                        <span
                            class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                    </a>


                <li class="nav-item p-0 ms-0 me-8 " role="presentation">
                    <a class="nav-link btn btn-color-muted px-0  active " data-bs-toggle="tab"
                       href="#collaborator_settings" aria-selected="false" role="tab" tabindex="-1">
                        <span class="nav-text fw-semibold fs-4 mb-3">
                            {{ trans("app.settings") }}
                            </span>
                        <span
                            class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                    </a>
                </li>


            </ul>
        </div>
    </div>


    <div class="tab-content mb-2">
        <div class="tab-pane fade show active" id="collaborator_settings" role="tabpanel">
            @component('components.group.card')
                @slot('title' , trans('app.settings'))
                <div class="row">
                    <x-form.form class="row" method="post" action="{{ route('profile.save') }}">
                        @bind($collaborator)
                        <h5 class="fw-bold m-0 pb-5">User infos</h5>
                        <x-form.file  col="pb-5" :src="$collaborator->image?->getPath()" name="image"
                                     label="{{ trans('app.avatar') }}"/>

                        <x-form.input  readonly  name="matricule" label="{{ trans('matricule') }}" col="col-12 col-md-3   pb-5 "/>
                        <x-form.input required name="cin" label="{{ trans('app.cin') }}" col="col-12 col-md-3   pb-5 "/>
                        <x-form.input required name="last_name" label="{{ trans('app.last_name') }}"
                                      col="col-12 col-md-3   pb-5 "/>
                        <x-form.input required name="first_name" label="{{ trans('app.first_name') }}"
                                      col="col-12 col-md-3   pb-5 "/>
                        <x-form.input-date readonly name="dob" label="{{ trans('app.dob') }}" col="col-12 col-md-3   pb-5 "/>
                        <x-form.select required :options=" \App\Enums\Gender::toArray()" name="gender"
                                       label="{{ trans('app.gender') }}" col="col-12 col-md-3   pb-5 "/>
                        <x-form.select  :options=" \App\Enums\Civility::toArray()" name="civility"
                                       label="{{ trans('app.civility') }}" col="col-12 col-md-3   pb-5 "/>
                        <x-form.input name="phone_number" label="{{ trans('app.phone_number') }}"
                                      col="col-12 col-md-3   pb-5 "/>
                        <x-form.input name="email" label="{{ trans('email') }}" col="col-12 col-md-4   pb-5 "/>
                        <x-form.select :bind-with="[\App\Models\City::all() , ['id' , 'name']]" name="city"
                                       label="{{ trans('app.city') }}" col="col-12 col-md-4   pb-5 "/>
                        <x-form.input name="postal_code" label="{{ trans('establishments.postal_code') }}"
                                      col="col-12 col-md-4    pb-5 "/>
                        <x-form.text-area  name="address" label="{{ trans('establishments.address') }}"
                                          col="col-12 col-md-6    pb-5 "/>
                        <x-form.text-area name="observation" label="{{ trans('establishments.observations') }}"
                                          col="col-12 col-md-6    pb-5 "/>

                        @endBinding
                        <div class="col-12 ">
                            <x-form.button/>
                        </div>
                    </x-form.form>
                    <div class="separator"></div>

                    <x-form.form class="row" method="post" action="{{ route('profile.account.update') }}">
                        @bind(user())
                        <h5 class="fw-bold m-0 py-5">Account infos</h5>
                        <x-form.select readonly disabled :options=" \App\Enums\YesNo::toArray()" name="is_manager"
                                       label="is manager" col="col-12 col-12   pb-5 "/>



                        <h5 class="fw-bold m-0 py-5 " id="account-security">Account security</h5>

                        @endBinding

                        @if($first_connection)
                            <x-form.input required col="col-12 col-md-6 mt-5 mb-8 " class="border  border-danger" type="password" name="password" :label="trans('auth.password')" />
                            <x-form.input required col="col-12 col-md-6 mt-5 mb-8 border-warning"  class="border  border-danger" type="password" name="password_confirmation" :label="trans('auth.password_confirm')" />

                        @else
                            <x-form.input  col="col-12 col-md-6 mt-5 mb-8 "  type="password" name="password" :label="trans('auth.password')" />
                            <x-form.input  col="col-12 col-md-6 mt-5 mb-8 border-warning"   type="password" name="password_confirmation" :label="trans('auth.password_confirm')" />

                        @endif



                        <div class="col-12 ">
                            <x-form.button/>
                        </div>
                    </x-form.form>


                </div>
            @endcomponent

        </div>


        <div class="tab-pane fade" id="collaborator_overview" role="tabpanel">
            @component('components.group.card')
                @slot('title' , "overview")
                Profile
            @endcomponent
        </div>


    </div>

@endsection

@push('style')
    <link href="assets/plugins/custom/cookiealert/cookiealert.bundle.css" rel="stylesheet" type="text/css"/>

@endpush
@push('script')

    <script src="assets/plugins/custom/cookiealert/cookiealert.bundle.js"></script>
@endpush
