<div class="app-navbar-item ms-1 ms-md-4">

    <div
        id="fdsfdsfdsf"
        class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px"
        data-kt-menu-trigger="{default: 'click'}"
        data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
        <i class="ki-duotone ki-element-11 fs-2">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
            <span class="path4"></span>
        </i>
    </div>

    <div class="menu menu-sub menu-sub-dropdown menu-column w-100 w-sm-350px"
         data-kt-menu="true" style="">

        <div class="card">

            <div class="card-header">

                <div class="card-title">
                    {{ trans('app.components.nav_bar.item.quick_access') }}
                </div>


                <div class="card-toolbar">

                    <button type="button"
                            class="btn btn-sm btn-icon btn-active-light-primary me-n3"
                            data-kt-menu-trigger="{default: 'click'}"
                            data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-setting-3 fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                        </i>
                    </button>

                    <div
                        class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
                        data-kt-menu="true" style="">



                        <div class="menu-item px-3" data-kt-menu-trigger="hover"
                             data-kt-menu-placement="right-end">
                            <a href="#" class="menu-link px-3">
                                <span class="menu-title">View Options</span>
                                <span class="menu-arrow"></span>
                            </a>

                            <div class="menu-sub menu-sub-dropdown w-175px py-4">




                                <div class="menu-item px-3">
                                    <div class="menu-content px-3">

                                        <label
                                            class="d-flex justify-content-between align-items-center form-check form-switch form-check-custom form-check-solid">

                                            <span class="form-check-label text-muted fs-6">By Modules</span>
                                            <input
                                                class="form-check-input w-30px h-20px"
                                                type="radio" value="1"
                                                checked
                                                name="notifications">

                                        </label>
                                        <label
                                            class="d-flex justify-content-between align-items-center form-check form-switch form-check-custom form-check-solid">

                                            <span class="form-check-label text-muted fs-6">Only Links</span>
                                            <input
                                                class="form-check-input w-30px h-20px"
                                                type="radio" value="2"
                                                name="notifications">

                                        </label>

                                    </div>
                                </div>

                            </div>

                        </div>




                    </div>


                </div>

            </div>


            <div class="card-body ">

                <div class="mh-450px scroll-y me-n5 ">


                    <div class="scroll navbar-apps h-400px px-1">


                        <div class="navbar-app navbar-app-container__hided row g-2">

                        </div>
                        <div class="navbar-app navbar-app-container row g-2">
                            @foreach(\App\View\Components\SideBar\Menu::getMenu() as $menu)
                                <div class="navbar-app row g-2" data-menu-id="{{ $menu['name'] }}"   data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $menu['name'] }}"  data-bs-delay-show="1000">
                                    <div class="menu-content navbar-app-name text-muted  fs-7 text-uppercase" >
                                        {{ $loop->index+1 }} - {{$menu['name']}}
                                    </div>
                                    @foreach($menu['pages'] as $page)

                                        <div class="col-4 navbar-app-link" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $page['name'] }}">
                                            <a href="{{ isset($page['route_name'])? route($page['route_name']) :  "#" }}"
                                               class="pulse d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                {{--                                                <img src="{{ asset('logo.svg') }}" class="w-25px h-25px mb-2" alt="">--}}
                                                <i class="{{ $menu['icon'] }} text-primary"></i>
                                                <span class="pulse-ring"></span>

                                                <span class="fw-semibold">
                                             {{ Str::limit($page['name'] , 30)  }}
                                        </span>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>





                    </div>


                </div>

            </div>

        </div>

    </div>


</div>
