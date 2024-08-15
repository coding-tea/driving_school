@extends('layouts.base')

@section('body')

    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">

        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">

            @include('partials.header')


            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">

                @include('partials.sidebar')

                {{-- @auth()
                    @if(user()->isTestAccount())
                        <div
                            class="notice d-flex bg-light-warning rounded border-warning border border-dashed  p-6 mb-6">

                            <i class="ki-outline ki-information fs-2tx text-warning me-4"></i>


                            <div class="d-flex flex-stack flex-grow-1 ">

                                <div class=" fw-semibold">
                                    <h4 class="text-gray-900 fw-bold">
                                        Logged with demo account
                                    </h4>

                                    <div class="fs-6 text-gray-700 ">
                                        Demo account cant change password or email , Please create a new account
                                        <a href="#" data-kt-scroll-toggle
                                           class="fw-bold">
                                            here
                                        </a>
                                    </div>
                                </div>


                            </div>

                        </div>
                    @endif
                @endauth --}}

                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">

                    <div class="d-flex flex-column flex-column-fluid">

                        <div id="kt_app_toolbar" class="app-toolbar py-4 py-lg-6 mb-8 mb-lg-10" data-kt-sticky="true"
                             data-kt-sticky-name="app-toolbar-sticky"
                             data-kt-sticky-offset="{default: 'false', lg: '300px'}">

                            <div id="kt_app_toolbar_container"
                                 class="app-container container-xxl d-flex flex-stack flex-wrap flex-lg-nowrap gap-4">

                                <div class="d-flex align-items-center">

                                    {{-- <img src="{{ asset('assets/images/b.png') }}" class="w-35px me-5"
                                         alt=""/> --}}


                                    <div class="page-title py-2 py-sm-0 d-flex flex-column justify-content-center me-3">

                                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                                            {{ $pageTitle ?? config('app.tag_line') }}
                                        </h1>

                                        <div class="">

                                            <x-group.bread-crumb/>
                                        </div>


                                    </div>

                                </div>


                                {{-- @include('includes.navbar.navbar') --}}



                            </div>


                        </div>


                        <div id="kt_app_content" class="app-content flex-column-fluid">

                            <div id="kt_app_content_container" class="app-container container-xxl">

                                <div class="row gy-5 g-xl-10">

                                    <div class="mb-xl-10">

                                        @yield('content')


                                    </div>


                                </div>


                            </div>

                        </div>

                    </div>


                    @include('partials.footer')

                </div>

            </div>

        </div>

    </div>
@endsection