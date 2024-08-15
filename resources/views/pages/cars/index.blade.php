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
                    {{ $item->profil->name }}
                </td>
                <td>
                    {{ $item->date }}
                </td>
                <td class="text-end">
                    <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">{{ trans('app.actions') }}
                        <i class="ki-outline ki-down fs-5 ms-1"></i>
                    </a>

                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                        data-kt-menu="true">

                        <div class="menu-item px-3">
                            <a href="{{ route('cars.destroy', $item) }}" class="menu-link px-3"
                                data-kt-users-table-filter="delete_row">{{ trans('app.delete') }}</a>
                        </div>

                    </div>

                </td>
            </tr>
        @endforeach
    @endcomponent

@endsection