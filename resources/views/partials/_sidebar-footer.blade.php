<div class="d-flex flex-column flex-center pb-4 pb-lg-8" id="kt_app_sidebar_footer">

    <div class="cursor-pointer symbol symbol-40px symbol-circle" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
        data-kt-attach="parent" data-kt-menu-placement="right-end">

        <div class="symbol  symbol-fixed position-relative">
            <img src="{{ asset('assets/images/profile.png') }}" class="h-40px w-40px" alt="user" />
            <div
                class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-primary rounded-circle border border-4 border-body h-20px w-20px">
            </div>
        </div>
    </div>

    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
        data-kt-menu="true">

        <div class="menu-item px-3">
            <div class="menu-content d-flex align-items-center px-3">


                <div class="symbol  symbol-fixed position-relative me-5">
                    {{-- <img src="{{ asset('assets/images/profile.svg') }}" --}}
                        {{-- alt="user" /> --}}
                    <div
                        class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-primary rounded-circle border border-4 border-body h-20px w-20px">
                    </div>
                </div>

                {{-- 
                <div class="d-flex flex-column">
                    {{-- <div class="fw-bold d-flex align-items-center fs-5">
                        {{ user()->owner->dto()->fullName() }}
                    </div>
                    {{-- <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">
                        {{ user()->owner->email }}
                    </a> 
                </div> 
                --}}

            </div>
        </div>


        <div class="separator my-2"></div>


        <div class="menu-item px-5">
            <a href="{{ route('profile.index') }}" class="menu-link px-5">
                {{ trans('user-management/profile.page_title') }}
            </a>
        </div>

        <div class="separator my-2"></div>


        <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
            data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
            <a href="#" class="menu-link px-5">
                <span class="menu-title position-relative">
                    {{ trans('app.mode.text') }}
                    <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                        <i class="ki-outline ki-night-day theme-light-show fs-2"></i>
                        <i class="ki-outline ki-moon theme-dark-show fs-2"></i>
                    </span></span>
            </a>

            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                data-kt-menu="true" data-kt-element="theme-mode-menu">

                <div class="menu-item px-3 my-0">
                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                        <span class="menu-icon" data-kt-element="icon">
                            <i class="ki-outline ki-night-day fs-2"></i>
                        </span>
                        <span class="menu-title">
                            {{ trans('app.mode.light') }}
                        </span>
                    </a>
                </div>


                <div class="menu-item px-3 my-0">
                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                        <span class="menu-icon" data-kt-element="icon">
                            <i class="ki-outline ki-moon fs-2"></i>
                        </span>
                        <span class="menu-title">
                            {{ trans('app.mode.dark') }}
                        </span>
                    </a>
                </div>


                <div class="menu-item px-3 my-0">
                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                        <span class="menu-icon" data-kt-element="icon">
                            <i class="ki-outline ki-screen fs-2"></i>
                        </span>
                        <span class="menu-title">
                            {{ trans('app.mode.system') }}
                        </span>
                    </a>
                </div>

            </div>

        </div>


        <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
            data-kt-menu-placement="left-start" data-kt-menu-offset="0, 0">
            <a href="#" class="menu-link px-5">
                <span class="menu-title position-relative">
                    {{ $lang->label() }}
                    <span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">
                        {{ $lang->label() }}
                        <img class="w-15px h-15px rounded-1 ms-2" src="{{ $lang->icon() }}" alt="" />
                    </span>
                </span>
            </a>
            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                @foreach ($langs as $lang)
                    <div class="menu-item px-3">
                        <a href="{{ route('setLang', $lang->value) }}" class="menu-link d-flex px-5 active">
                            <span class="symbol symbol-20px me-4">
                                <img class="rounded-1" src="{{ $lang->icon() }}" alt="" />
                            </span>{{ $lang->label() }}
                        </a>
                    </div>
                @endforeach


            </div>
        </div>


        <div class="menu-item px-5">
            <a href="{{ route('logout') }}" class="menu-link px-5">
                {{ trans('auth.logout') }}
            </a>
        </div>

    </div>

</div>
