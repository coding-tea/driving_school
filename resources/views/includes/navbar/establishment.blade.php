<div class="app-navbar-item ms-1 ms-md-4">
    <div class="d-flex align-items-center ms-lg-5 bg-light-dark" id="kt_header_user_menu_toggle">
        @if(establishment() != null)
            <div class="btn btn-active-light d-flex align-items-center bg-hover-light py-2 px-2 px-md-3"
                 data-kt-menu-trigger="{default: 'click'}" data-kt-menu-attach="parent"
                 data-kt-menu-placement="bottom-end">
                <div class="symbol symbol-30px symbol-md-40px me-5">
                    <img src="{{stream_image_from_uploads(establishment()->image?->getPath()) }}"
                         alt="image">
                </div>
                <div class="d-none d-sm-flex flex-column align-items-start justify-content-start ">
                    <span class="text-muted fs-7 fw-semibold  mb-2">{{ establishment()->name }}</span>
                    <span class="text-gray-900 fs-base fw-bold lh-1">{{ establishment()->name_abrg }}</span>
                </div>
            </div>
        @endif
        <div
            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
            data-kt-menu="true" style="">
            <div class="menu-item px-5">
                <div class="border rounded">
                    <select id="kt_docs_select2_rich_content" class="form-select form-select-transparent" name="..."
                            data-placeholder="Establishements">
                        <option></option>
                        {{-- @foreach(user()->owner->establishements as $as) --}}
                            <option selected
                                    {{-- value="{{ route('selectetab' , user()->owner->establishements) }}" --}}
                                    {{-- data-id="{{ user()->owner->establishements->id }}"
                                    data-name="{{ user()->owner->establishements->name }}"
                                    data-name-abrg="{{ user()->owner->establishements->name_abrg }}"
                                    data-img=" {{stream_image_from_uploads( user()->owner->establishements->image?->getPath()) }} " --}}
                            >
                                {{-- {{user()->owner->establishements->name}}
                                {{user()->owner->establishements->name_abrg}} --}}
                            </option>
                        {{-- @endforeach --}}
                    </select>
                </div>
            </div>
            @if(establishment() != null)
                <div class="menu-item px-5">
                    <a href="{{ route('etablissement.show' , establishment()) }}" class="menu-link px-5">
                        {{ trans('establishments.page_edit.page_title') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
