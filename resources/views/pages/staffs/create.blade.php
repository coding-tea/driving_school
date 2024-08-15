@extends('layouts.app')
@include('components.consultation')

@section('content')
    @component('components.group.card')
        @slot('title', 'Profile')
        <x-form.form method="post" action="{{ route('profile.store') }}">

            <div class="col-12 col-sm-6 pb-5">
                <x-form.file required name="image" label="{{ trans('profile.image') }}" />
            </div>

            <div class="col-12 col-sm-6 pb-5">
                <x-form.file required name="cinimage" label="{{ trans('profile.cin') }}" />
            </div>

            <x-form.input required :bootstrap-max-length="true" maxlength="100" col="col-12 col-sm-6 mt-5" name="name"
                label="{{ trans('profile.name') }}" />

            <x-form.input required :bootstrap-max-length="true" maxlength="100" col="col-12 col-sm-6 mt-5" name="name_ar"
                label="{{ trans('profile.name_ar') }}" />

            <x-form.input required :bootstrap-max-length="true" maxlength="100" col="col-12 col-sm-6 mt-5" name="adress"
                label="{{ trans('profile.adress') }}" />

            <x-form.input-date required col="col-12 col-sm-6 mt-5" name="birthday"
                label="{{ trans('profile.birthday') }}" />

            <x-form.input required :bootstrap-max-length="true" maxlength="40" col="col-12 col-sm-6 mt-5" name="birth_city"
                label="{{ trans('profile.birth_city') }}" />

            <x-form.input required :bootstrap-max-length="true" maxlength="10" col="col-12 col-sm-6 mt-5" name="cin"
                label="{{ trans('profile.cin') }}" />

            <x-form.input required :bootstrap-max-length="true" maxlength="100" col="col-12 col-sm-6 mt-5" name="reference"
                label="{{ trans('profile.reference') }}" />

            <x-form.input-date required col="col-12 col-sm-6 mt-5" name="signin_date"
                label="{{ trans('profile.signin_date') }}" />

            <div class="col-12 mt-5">
                <x-form.button />
            </div>

        </x-form.form>
    @endcomponent

    {{-- <x-data-import download-route="profile.download" name="file" :show-button-export-data-table="true" :show-button-export-model="false" :actions="$actions">
    </x-data-import> --}}
@endsection

@push('style')
@endpush

@push('script')
    <script></script>
@endpush

@vite(pageJs('dashboard'))
