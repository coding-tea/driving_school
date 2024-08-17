@extends('layouts.app')
@include('components.consultation')

@section('content')
    @component('components.group.card')
        @slot('title', 'Profile')
        <x-form.form method="post" action="{{ route('staffs.store') }}">

            <x-form.input required :bootstrap-max-length="true" maxlength="100" col="col-12 col-sm-12 mt-5" name="name"
                label="{{ trans('profile.name') }}" />

            <div class="col-12 col-sm-12 mt-5">
                <label for="role" class="form-label"> {{ trans('staffs.role') }} </label>
                <select class="form-select" id="role" data-control="select2" data-placeholder="Select an option"
                    name="role" id="user_id">
                    <option></option>
                    <option value="admin"> {{ trans('staffs.admin') }} </option>
                    <option value="instructor"> {{ trans('staffs.instructor') }} </option>
                </select>
            </div>

            <div class="col-12 mt-5">
                <x-form.button />
            </div>

        </x-form.form>
    @endcomponent

    {{-- <x-data-import download-route="staffs.download" name="file" :show-button-export-data-table="true" :show-button-export-model="false" :actions="$actions">
    </x-data-import> --}}
@endsection