
<div class="app-navbar-item ms-1 ms-md-4">

    <div
        id="fdsfdsfdsfds"
        class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px"
        data-kt-menu-trigger="{default: 'click'}"
        data-kt-menu-attach="parent"
        data-kt-menu-placement="bottom-end">
        <i class="ki-duotone ki-magnifier fs-2">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </div>

    <div class="menu menu-sub menu-sub-dropdown menu-column w-100 w-sm-350px"
         data-kt-menu="true" style="">

        <div class="card">

            <div class="p-3 d-flex justify-content-center align-content-center">
                <input type="text"
                       class="form-control border rounded  border-gray-300 form-control-flush ps-10"
                       name="app-search"
                       value=""
                       placeholder="Search..."
                       data-kt-search-element="input"/>


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

                        <div class="menu-item px-3">
                            <div
                                class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                                Payments
                            </div>
                        </div>


                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">Create Invoice</a>
                        </div>


                        <div class="menu-item px-3">
                            <a href="#" class="menu-link flex-stack px-3">Create
                                Payment
                                <span class="ms-2" data-bs-toggle="tooltip"
                                      aria-label="Specify a target name for future usage and reference"
                                      data-bs-original-title="Specify a target name for future usage and reference"
                                      data-kt-initialized="1">
																<i class="ki-duotone ki-information fs-6">
																	<span class="path1"></span>
																	<span class="path2"></span>
																	<span class="path3"></span>
																</i>
															</span></a>
                        </div>


                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">Generate Bill</a>
                        </div>


                        <div class="menu-item px-3" data-kt-menu-trigger="hover"
                             data-kt-menu-placement="right-end">
                            <a href="#" class="menu-link px-3">
                                <span class="menu-title">Subscription</span>
                                <span class="menu-arrow"></span>
                            </a>

                            <div class="menu-sub menu-sub-dropdown w-175px py-4">

                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">Plans</a>
                                </div>


                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">Billing</a>
                                </div>


                                <div class="menu-item px-3">
                                    <a href="#"
                                       class="menu-link px-3">Statements</a>
                                </div>


                                <div class="separator my-2"></div>


                                <div class="menu-item px-3">
                                    <div class="menu-content px-3">

                                        <label
                                            class="form-check form-switch form-check-custom form-check-solid">

                                            <input
                                                class="form-check-input w-30px h-20px"
                                                type="checkbox" value="1"
                                                checked="checked"
                                                name="notifications">


                                            <span
                                                class="form-check-label text-muted fs-6">Recuring</span>

                                        </label>

                                    </div>
                                </div>

                            </div>

                        </div>


                        <div class="menu-item px-3 my-1">
                            <a href="#" class="menu-link px-3">Settings</a>
                        </div>

                    </div>


                </div>

            </div>


            <div class="p-5">

                <div class="scroll-y  mh-lg-325px ">
                    <div class="users">
                        <div class="d-flex flex-stack fw-semibold mb-5">
                            <span class="text-muted fs-base me-2">Users:</span>
                        </div>

                        {{-- @foreach(\App\Models\UserManagement\Collaborator::all() as $col)
                            @if($loop->index<5)
                                <a href="{{ route('collaborators.show' , $col) }}"
                                   class="d-flex  text-gray-900 text-hover-primary align-items-center mb-5 user-item user-item-showed">
                                    <div class="symbol symbol-40px me-4">
                                        <img src="{{ stream_image_from_uploads($col->image?->getPath() ,[ 'default' => \App\Services\ImageService::DEFAULT_PERSON] )  }}"
                                             alt="">
                                    </div>
                                    <div class="d-flex flex-column justify-content-start fw-semibold">
                                        <span class="fs-6 fw-semibold"
                                              data-user-item-fullname="{{ $col->dto()->fullname() }}">
                                            {{ $col->dto()->fullname() }}
                                        </span>
                                        <span class="fs-7 fw-semibold text-muted"
                                              data-user-item-cin="{{ $col->dto()->fullname() }}"
                                        >
                                             #{{ $col->cin }}
                                        </span>
                                    </div>
                                </a>
                            @else
                                <a href="{{ route('collaborators.show' , $col) }}"
                                   class="d-none d-flex text-gray-900 text-hover-primary align-items-center mb-5 user-item user-item-hided">
                                    <div class="symbol symbol-40px me-4">
                                        <img src="{{ stream_image_from_uploads($col->image?->getPath() ,[ 'default' => \App\Services\ImageService::DEFAULT_PERSON] )  }}"
                                             alt="">
                                    </div>
                                    <div class="d-flex flex-column justify-content-start fw-semibold">
                                        <span class="fs-6 fw-semibold "
                                              data-user-item-fullname="{{ $col->dto()->fullname() }}">
                                            {{ $col->dto()->fullname() }}
                                        </span>
                                        <span class="fs-7 fw-semibold text-muted"
                                              data-user-item-cin="{{ $col->dto()->fullname() }}"
                                        >
                                             #{{ $col->cin }}
                                        </span>
                                    </div>
                                </a>
                                @if($loop->index>100)
                                    <a href="{{ route('collaborators.index') }}"
                                       class="d-flex text-gray-900 text-hover-primary align-items-center mb-5">
                                        <div class="symbol text-center symbol-40px me-4">
                                            Show More
                                        </div>
                                    </a>

                                    @break
                                @endif

                            @endif
                        @endforeach --}}

                    </div>

                    <div class="links">
                        <div class="d-flex flex-stack fw-semibold mb-5">
                            <span class="text-muted fs-base me-2">Links:</span>
                        </div>
                        {{-- @foreach(\App\Models\UserManagement\Collaborator::all() as $col)
                            @if($loop->index<20)
                                <div class="d-flex align-items-center mb-5">
                                    <div class="symbol symbol-40px me-4">
                                    <span class="symbol-label bg-light">
                                        <i class="ki-duotone ki-chart fs-2 text-primary">
                                            <span class="path1"></span><span
                                                class="path2"></span></i>
                                    </span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-semibold">"KPI
                                            Monitoring App Launch</a>
                                        <span class="fs-7 text-muted fw-semibold">#84250</span>
                                    </div>
                                </div>
                            @else
                                @break
                            @endif
                        @endforeach --}}
                    </div>
                </div>

            </div>

        </div>

    </div>


</div>
