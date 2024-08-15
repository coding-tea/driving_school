@extends('layouts.app')
@include('components.consultation')

@section('content')
    @component('components.group.card')
        @slot('title', 'Edit Office')
        @bind($item)
        <x-form.form method="post" action="{{ route('offices.update', $item->id) }}">

            <div class="col-12 col-sm-12 pb-5">
                <x-form.file :src="$item?->image?->path" name="image_id" label="{{ trans('office.image_id') }}" />
            </div> 

            <x-form.input required :bootstrap-max-length="true" maxlength="100" col="col-12 col-sm-6 mt-5" name="name"
                label="{{ trans('office.name') }}" />

            <x-form.input required :bootstrap-max-length="true" maxlength="100" col="col-12 col-sm-6 mt-5" name="adress"
                label="{{ trans('office.adress') }}" />

            <div class="col-12 mt-5">
                <x-form.button />
            </div>

        </x-form.form>
        @endBinding
    @endcomponent

    {{-- <x-data-import download-route="profile.download" name="file" :show-button-export-data-table="true" :show-button-export-model="false" :actions="$actions">
    </x-data-import> --}}
@endsection