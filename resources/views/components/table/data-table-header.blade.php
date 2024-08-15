@props([
    'actions' => [],
    'heads' => [],
    'id' => Str::uuid(),
    'identifier' => Str::uuid(),
    'showCheckbox' => true,

    ])

<div class="card dt-container" >
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                       xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                          transform="rotate(45 17.0365 15.1223)" fill="currentColor"/>
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="currentColor"/>
                                  </svg>
                                </span>
                <input type="text" data-kt-user-table-filter="search"
                       mrx-dt-search="{{ $id }}"
                       class="form-control form-control-solid w-250px ps-14"
                       placeholder=""/>
            </div>
        </div>
        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
            {{ $moreActions ?? null }}
            @if(is_array($actions) && count($actions))
                <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0  fw-semibold ">
                    <li class="nav-item ms-auto">
                        <a href="#" class="btn btn-primary ps-7" data-kt-menu-trigger="click"
                           data-kt-menu-attach="parent"
                           data-kt-menu-placement="bottom-end">
                            {{ ucwords(trans('app.actions')) }}
                            <span class="svg-icon svg-icon-2 me-0"></span>
                        </a>

                        <div

                            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold py-4 w-250px fs-6"
                            data-kt-menu="true">
                            <div class="menu-item px-5">
                                <div
                                    class="menu-content text-muted pb-2 px-5 fs-7 text-uppercase">  {{ ucwords(trans('app.actions')) }}</div>
                            </div>
                            @foreach($actions as $action)
                                <x-table.action id="kt_datatable_zero_configuration" :action="$action"/>
                            @endforeach
                        </div>

                    </li>
                </ul>
            @endif

        </div>

    </div>
    <div class="card-body py-4">
        <div class="table-responsive">
            <table mrx-dt="true"
                   data-table-identifier="{{ $identifier }}"
                   id="{{ $id }}"
                   class="table  table-row-dashed fs-6 gy-5 dataTable no-footer">
                <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    @if($showCheckbox)
                        <th class="no-sort  w-10px pe-2">
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox"/>
                            </div>
                        </th>
                    @endif

                    @foreach($heads as $head)
                        <th class="min-w-100px">{{ $head->getShowAs() }}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                {{ $slot }}
                </tbody>
            </table>
        </div>
    </div>
</div>
