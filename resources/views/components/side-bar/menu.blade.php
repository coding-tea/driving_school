<div id="kt_app_sidebar" class="app-sidebar" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
     data-kt-drawer-width="auto" data-kt-drawer-direction="start"
     data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">

    <div class="app-sidebar-primary">


        @include('partials._app-logo')

        <div class="app-sidebar-menu flex-grow-1 hover-scroll-overlay-y scroll-ps mx-2 my-5"
             id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-height="auto"
             data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
             data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px">

            <div id="kt_aside_menu"
                 class="menu menu-rounded menu-column menu-title-gray-600 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-semibold fs-6"
                 data-kt-menu="true">


                @foreach($menus as $menu)
                    <div data-kt-menu-trigger="{default: 'click'}"
                         data-kt-menu-placement="right-start"

                         class="menu-item  @if(isset($menu['current']) && $menu['current']) active-menu @endif    py-2">

                        <span class="menu-link menu-center">
                                    <span class="menu-icon me-0">
                                        <i class="{{$menu['icon']}}"></i>
                                    </span>
						</span>


                        <div class="menu-sub menu-sub-dropdown px-2 py-4 w-250px mh-75 overflow-auto">

                            <div class="menu-item">

                                <div class="menu-content">
                                    <span
                                        class="menu-section fs-5 fw-bolder ps-1 py-1">{{ ucwords($menu['name']) }}</span>
                                </div>

                            </div>

                            @foreach($menu['pages'] as $page)
                                @if(isset($page['pages']))
                                    <div data-kt-menu-trigger="click"
                                         class="menu-item   @if(isset($page['current']) && $page['current']) active-menu show  @endif   menu-accordion mb-1">
                                        <span class="menu-link">
                                         <span class="menu-bullet">
														<span class="bullet bullet-dot"></span>
                                         </span>
                                             <span class="menu-title">{{ $page['name'] }}</span>
                                             <span class="menu-arrow"></span>
                                       </span>
                                        <div class="menu-sub menu-sub-accordion px-5" >
                                            @foreach($page['pages'] as $pageX)
                                                <div class="menu-item ">

                                                    <a class="menu-link @if(isset($pageX['current']) && $pageX['current']) active  @endif"
                                                       href="{{ isset($pageX['route_name']) ? route($pageX['route_name']) : '#' }}">
                                                         <span class="menu-bullet">
                                                           <span class="bullet bullet-dot"></span>
                                                         </span>
                                                        <span class="menu-title">{{ $pageX['name'] }}</span>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="sidebar-menu-item menu-item">
                                        <a class="menu-link @if(isset($page['route_name']) && request()->url() == route($page['route_name'])) active  @endif  "
                                           href="{{ isset($page['route_name']) ? route($page['route_name']) : '#' }}">
													<span class="menu-bullet">
														<span class="bullet bullet-dot"></span>
													</span>
                                            <span class="menu-title">{{$page['name'] }}</span>
                                        </a>
                                    </div>
                                @endif
                            @endforeach


                        </div>

                    </div>

                @endforeach

            </div>

        </div>


        @include('partials._sidebar-footer')
    </div>


    {{-- <div class="app-sidebar-secondary ">

        <div class="d-flex flex-column">

            <div class="d-flex flex-column pt-10 ps-11" id="kt_app_sidebar_secondary_header">

                <a href="{{ route('dashboard') }}" class="d-flex align-items-center custom-link fs-6 fw-semibold mb-5">
                    <i class="ki-outline ki-black-left fs-2 me-3 text-white opacity-50"></i>
                    {{ trans('app.back') }}
                </a>

                <span class="fs-2 fw-bolder text-white">
                    {{ $cur_menu['name'] ?? '' }}
                </span>
            </div>


            <div
                class="app-sidebar-secondary-menu menu menu-sub-indention menu-rounded menu-column menu-active-bg menu-title-gray-600 menu-icon-gray-500 menu-state-primary menu-arrow-gray-500 fw-semibold fs-6 py-4 py-lg-6"
                id="kt_app_sidebar_secondary_menu" data-kt-menu="true">
                <div id="kt_app_sidebar_secondary_menu_wrapper" class="hover-scroll-y px-3 mx-3"
                     data-kt-scroll="true" data-kt-scroll-activate="{default: true, lg: true}"
                     data-kt-scroll-height="auto"
                     data-kt-scroll-dependencies="#kt_app_sidebar_secondary_header"
                     data-kt-scroll-wrappers="#kt_app_sidebar_secondary_menu" data-kt-scroll-offset="20px">


                    @if(isset($cur_menu , $cur_menu['pages']))

                        @foreach( $cur_menu['pages'] as $page)
                            @if(isset($page['pages']))
                                <div data-kt-menu-trigger="click"
                                     class="menu-item   @if(isset($page['current']) && $page['current']) active-menu show  @endif   menu-accordion mb-1">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                               <i class="{{ $page['icon'] }}   me-1"></i>
                                            </span>

                                             <span class="menu-title">{{ $page['name'] }}</span>
                                             <span class="menu-arrow"></span>
                                       </span>
                                    <div class="menu-sub menu-sub-accordion">
                                        @foreach($page['pages'] as $pageX)
                                            <div class="menu-item ">

                                                <a class="menu-link @if(isset($pageX['current']) && $pageX['current']) active  @endif"
                                                   href="{{ isset($pageX['route_name']) ? route($pageX['route_name']) : '#' }}">
                                                         <span class="menu-bullet">
                                                           <span class="bullet bullet-dot"></span>
                                                         </span>
                                                    <span class="menu-title">{{ $pageX['name'] }}</span>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="sidebar-menu-item menu-item">
                                    <a class="menu-link @if(isset($page['route_name']) && request()->url() == route($page['route_name'])) active  active-menu @endif  "
                                       href="{{ isset($page['route_name']) ? route($page['route_name']) : '#' }}">
                                         <span class="menu-icon">
                                             <i class="{{ $page['icon'] ?? "" }}   me-1"></i>
                                         </span>
                                        <span class="menu-title">{{$page['name'] }}</span>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>


    </div> --}}


    {{-- <button id="kt_app_sidebar_secondary_toggle"
            class="app-sidebar-secondary-toggle btn btn-sm btn-icon bg-body btn-color-gray-600 btn-active-color-primary position-absolute translate-middle z-index-1 start-100 end-0 bottom-0 shadow-sm d-none d-lg-flex mb-4"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-secondary-collapse">
        <i class="ki-outline ki-arrow-left fs-2 rotate-180"></i>
    </button> --}}


</div>

