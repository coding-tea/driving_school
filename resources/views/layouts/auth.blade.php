@extends('layouts.base')

@section('body')
    <div class="d-flex flex-column flex-lg-row-fluid justify-content-center align-items-center h-100">
        <div class="d-flex flex-center flex-column flex-lg-row-fluid justify-content-center align-items-center">
            @yield('content')
            <div class="row w-100">
                <div class="col-12">
                        <div class="me-10">

                            <button
                                class="btn btn-flex btn-link btn-color-gray-700 btn-active-color-primary rotate fs-base"
                                data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                data-kt-menu-placement="bottom-start"
                                data-kt-menu-offset="0px, 0px">
                                <img data-kt-element="current-lang-flag" class="w-20px h-20px rounded me-3"
                                     src="{{ $lang->icon() }}" alt="">

                                <span data-kt-element="current-lang-name" class="me-1">{{ $lang->label() }}</span>

                                <span class="d-flex flex-center rotate-180">
                                  <i class="ki-outline ki-down fs-5 text-muted m-0"></i>
                                </span>
                            </button>


                            <div
                                class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-4 fs-7"
                                data-kt-menu="true" id="kt_auth_lang_menu">

                                @foreach($langs as $lang)

                                    <div class="menu-item px-3">
                                        <a href="{{ route('setLang', $lang->value) }}" class="menu-link d-flex px-5"
                                           data-kt-lang="English">
                                <span class="symbol symbol-20px me-4">
                                    <img data-kt-element="lang-flag" class="rounded-1" src="{{$lang->icon()}}" alt="">
                                </span>
                                            <span data-kt-element="lang-name">
                                        {{ $lang->label() }}
                                    </span>
                                        </a>
                                    </div>
                                @endforeach


                            </div>

                        </div>
                </div>

                <div class="col-12">
                        <div class="" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                             data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                            <a href="#" class="menu-link px-5">
                                <span class="d-flex justify-content-start align-items-start">

                                    <span class="me-5">
                                        <i class="ki-outline ki-night-day theme-light-show fs-2"></i>
                                        <i class="ki-outline ki-moon theme-dark-show fs-2"></i>
                                    </span>
                                     <span class="me-5">
                                        {{trans('app.mode.text')}}


                                    </span>

                                    <span>
                                        <span class="d-flex flex-center rotate-180">
                                                <i class="ki-outline ki-down fs-5 text-muted m-0"></i>
                                            </span>
                                    </span>

                                </span>
                            </a>

                            <div
                                class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                                data-kt-menu="true" data-kt-element="theme-mode-menu">

                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                       data-kt-value="light">
													<span class="menu-icon" data-kt-element="icon">
														<i class="ki-outline ki-night-day fs-2"></i>
													</span>
                                        <span class="menu-title">
                                              {{trans('app.mode.light')}}
                                        </span>
                                    </a>
                                </div>


                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                       data-kt-value="dark">
													<span class="menu-icon" data-kt-element="icon">
														<i class="ki-outline ki-moon fs-2"></i>
													</span>
                                        <span class="menu-title">
                                              {{trans('app.mode.dark')}}
                                        </span>
                                    </a>
                                </div>


                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                       data-kt-value="system">
													<span class="menu-icon" data-kt-element="icon">
														<i class="ki-outline ki-screen fs-2"></i>
													</span>
                                        <span class="menu-title">
                                              {{trans('app.mode.system')}}
                                        </span>
                                    </a>
                                </div>

                            </div>

                        </div>
                </div>
            </div>
        </div>


    </div>
@endsection

