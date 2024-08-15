    <div class="card dt-container">
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
                       mrx-dt-search="{{ $id() }}"
                       class="form-control form-control-solid w-250px ps-14"
                       placeholder=""/>
            </div>
        </div>
        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">


            {!! $moreHtmlActions !!}
            @if(isCleanArray($actions))
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
                                <x-table.action :id="$id()" :action="$action"/>
                        @endforeach


                    </li>
                </ul>
            @endif
        </div>
    </div>
    <div class="card-body py-4">
        <div class="table-responsive">
            <table mrx-dt="true" @if(isset($identifier)) data-table-identifier="{{ $identifier }}"
                   @endif  class="table align-middle table-row-dashed fs-6 gy-4"
                   id="{{ $id() }}">
                <thead>
                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">

                    @if($showCheckBoxes)
                        <th class="no-sort  w-10px pe-2">
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input id="{{ $inputCheckAllId() }}" class="form-check-input" type="checkbox"
                                       value="1"/>
                            </div>
                        </th>
                    @endif

                    @foreach($heads as $head)
                        <th class="min-w-100px">{{ $head->getShowAs() }}</th>
                    @endforeach


                    @if(!empty($editRoute) || !empty($deleteRoute) || isset($moreRoutes) && count($moreRoutes))
                        <th class="no-sort ">
                            {{ ucwords(trans('app.actions')) }}
                        </th>
                    @endif

                </tr>
                </thead>
                <tbody class="fw-bold text-gray-600">

                @if(isCleanArray($dataCollection->toArray()))

                    @foreach($dataCollection as $model)
                        <tr mrx-dt-tr-id="{{ \Illuminate\Support\Str::random(8) }}">
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input {{ $generateTbodyInputCheckboxClass() }}"
                                           type="checkbox" value="{{ $model["id"] }}"/>
                                </div>
                            </td>
                            @if(isCleanArray($heads))
                                @foreach($heads as $head)
                                    <td data=" {{ $model->getRawOriginal($head->getName()) }}">


                                        @switch($head->getType())

                                            @case(\App\View\Head::TYPE_TEXT)
                                                <x-helpers.show-more :text="$model->getRawOriginal($head->getName())"/>

                                                @break
                                            @case(\App\View\Head::TYPE_IMG)
                                                <div class="d-flex align-items-center">

                                                    <a class="d-block overlay" data-fslightbox="lightbox-basic"
                                                       href="{{ $image($model) }}">
                                                        <div class="symbol symbol-50px me-3">
                                                            <x-media.image
                                                                    :alt="$image($model) "
                                                                    :src="$image($model)"/>

                                                        </div>
                                                    </a>

                                                </div>
                                                @break
                                            @case(\App\View\Head::TYPE_OPTIONS)
                                                @foreach($head->getOptions() as $key => $val)
                                                    @if($model->getRawOriginal($head->getName()) == $key)
                                                        {!!  $val !!}
                                                    @endif
                                                @endforeach
                                                @break
                                            @case(\App\View\Head::TYPE_FILE)
                                                @php
                                                    $html = '';
                                                    if (!empty($model->getRawOriginal($head->getName())) && Storage::disk('local')->has($model->getRawOriginal($head->getName()))) {
                                                          $filePath = pathinfo(storage_path($model->getRawOriginal($head->getName())))['basename'];
                                                          $fileSize = byteConvert(Storage::disk('local')->size($model->getRawOriginal($head->getName())));
                                                          $html = "<div> nom de fichier  :<span class='badge badge-secondary'>$filePath</span>  </div> <div>size :<span class='badge badge-secondary'>$fileSize</span>   </div>";
                                                    };
                                                @endphp
                                                {!! $html !!}
                                                @break
                                            @case(\App\View\Head::TYPE_DATE)
                                                @if($model->getRawOriginal($head->getName()) !== null && \Carbon\Carbon::parse($model->getRawOriginal($head->getName()))->isValid())
                                                    @if(isset($head->getOptions()['format']))
                                                        {{ \Carbon\Carbon::parse($model->getRawOriginal($head->getName()))->translatedFormat($head->getOptions()['format']  ) }}
                                                    @else
                                                        {{ $model->getRawOriginal($head->getName()) }}
                                                    @endif
                                                @endif
                                                @break

                                            @case(\App\View\Head::TYPE_COLOR)
                                                <div style="background-color: {{ $model[$head->getName()] }}  ;  height: 35px;
    width: 74px;"></div>
                                                @break
                                        @endswitch
                                    </td>
                                @endforeach
                            @endif
                            @if(isCleanArray($actions))
                                <td class="text-end d-flex justify-content-start align-content-start">
                                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm "
                                       data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        {{ ucwords(trans('app.actions')) }}

                                        <span class="svg-icon svg-icon-5 m-0">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                fill="currentColor"/>
                                    </svg>
                                </span>
                                    </a>

                                    <div
                                            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true">


                                        @if(!empty($editRoute) || !empty($deleteRoute) || isset($moreRoutes) && count($moreRoutes))
                                            @if(isset($editRoute) && !empty($editRoute))

                                                <div class="menu-item px-3">
                                                    <a href="{{ $route($model,$editRoute) }}"
                                                       class="menu-link px-3">  {{ ucwords(trans('app.edit')) }}</a>
                                                </div>
                                            @endif
                                            @if(isset($deleteRoute) && !empty($deleteRoute))
                                                <div class="menu-item px-3 ">
                                                    <a href="{{ $route($model,$deleteRoute) }}"
                                                       class="menu-link px-3 text-danger delete-record">  {{ ucwords(trans('app.delete')) }}</a>
                                                </div>
                                            @endif
                                        @endif

                                        @foreach($moreRoutes as $route_info )
                                            <div class="menu-item px-3 ">
                                                <a
                                                        data-id="{{ $route_info['id'] ?? null}}"
                                                        id="{{ Str::replace('.','-',$route_info['name'] ) }}"
                                                        @if(isset($route_info['blank'] )) target="_blank" @endif
                                                        href='{{ $getFullUrlFromMoreRoute($route_info, $model) }}'
                                                        class="menu-link px-3">
                                                    {{ $route_info['name'] }}
                                                </a>
                                            </div>

                                        @endforeach


                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach

                @endif


                </tbody>
            </table>
        </div>
    </div>
</div>


