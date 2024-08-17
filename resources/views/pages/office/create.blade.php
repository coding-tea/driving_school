@extends('layouts.app')
@include('components.consultation')

@section('content')
    @component('components.group.card')
        @slot('title', 'Offices')
        <x-form.form method="post" action="{{ route('offices.store') }}">

            <div class="col-12 col-sm-6 pb-5">
                <x-form.file required name="image_id" label="{{ trans('office.image') }}" />
            </div>

            <x-form.input required :bootstrap-max-length="true" maxlength="100" col="col-12 col-sm-12 mt-5" name="name"
                label="{{ trans('office.name') }}" />

            <x-form.input required :bootstrap-max-length="true" maxlength="100" col="col-12 col-sm-6 mt-5" name="adress"
                label="{{ trans('office.adress') }}" />


                {{-- @dd($users) --}}

            <div class="col-12 col-sm-6 mt-5"> 
                <label for="user_id" class="form-label"> {{ trans('office.user_id') }} </label>
                <select class="form-select" data-control="select2" data-placeholder="Select an option" name="user_id" id="user_id">
                    <option></option>
                    @foreach ($users as $item)
                    {{-- @dd($item) --}}
                        <option value="{{ $item->id }}"> {{ $item->login }} </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 mt-5">
                <x-form.button />
            </div>

        </x-form.form>
    @endcomponent

    {{-- <x-data-import download-route="office.download" name="file" :show-button-export-data-table="true" :show-button-export-model="false" :actions="$actions">
    </x-data-import> --}}
@endsection
