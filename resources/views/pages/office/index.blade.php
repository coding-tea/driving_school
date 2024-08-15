@extends('layouts.app')
@include('components.consultation')

@section('content')

    @component('components.table.data-table-header', [
        'heads' => $heads,
        'actions' => $actions,
    ])
        @foreach ($data as $item)
            <tr id="{{ $item['id'] }}">
                <x-table.data-table-tobody-checkbox id="{{ $item['id'] }}" />
                <td>
                    <div class="symbol  symbol-50px overflow-hidden me-3">
                        <div class="symbol-label">
                            <img src="{{ stream_image_from_uploads($item?->image?->path) }}" alt="Emma Smith" class="w-100">
                        </div>
                    </div>
                </td>
                <td>
                    {{ $item->name }}
                </td>
                <td>
                    {{ $item->adress }}
                </td>
                <td class="text-end">
                    <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">{{ trans('app.actions') }}
                        <i class="ki-outline ki-down fs-5 ms-1"></i>
                    </a>

                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                        data-kt-menu="true">

                        <div class="menu-item px-3">
                            <a href="{{ route('offices.show', $item) }}" class="menu-link px-3">{{ trans('app.edit') }}</a>
                        </div>

                        <div class="menu-item px-3">
                            <a href="{{ route('offices.destroy', $item) }}" class="menu-link px-3"
                                data-kt-users-table-filter="delete_row">{{ trans('app.delete') }}</a>
                        </div>

                    </div>

                </td>
            </tr>
        @endforeach
    @endcomponent


    {{-- @bind($data)
        <x-table.data-table :actions="$actions" :heads="$heads" edit-route="offices.show" delete-route="offices.destroy" />
    @endBinding --}}

    {{-- <x-data-import download-route="profile.download" name="file" :show-button-export-data-table="true" :show-button-export-model="false" :actions="$actions">
    </x-data-import> --}}
@endsection
