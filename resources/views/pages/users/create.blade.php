
@extends('layouts.app')
@include('components.edition')


@section('content')

    @component('components.group.card')
        @slot('title' , 'Add User')
        @slot('buttons')
        @endslot

        <x-form.form
            method="post"

            action="{{ route('users.store') }}"
        >

            <div class="col-2">
                <x-form.file required  name="image" label="{{ trans('app.avatar') }}"/>
            </div>
            <div class="row  col-10">
                <x-form.input required :bootstrap-max-length="true" maxlength="255" col="col-sm-4" name="first_name"
                              label="{{ trans('app.first_name') }}"/>
                <x-form.input required :bootstrap-max-length="true" maxlength="255" col="col-sm-4" name="last_name"
                              label="{{ trans('app.last_name') }}"/>
                <x-form.input required  col="col-sm-4 " name="cin"
                              label="{{ trans('app.cin') }}"/>
                <x-form.input-date required  col="col-sm-4 mt-5" name="dob"
                                   label="{{ trans('app.dob') }}"/>
                <x-form.select col="col-12 col-sm-4  mt-5"
                               name="gender"
                               label="{{ trans('app.gender') }}"
                               :options="\App\Enums\Gender::toArray()"
                />
                <x-form.input required :bootstrap-max-length="true" maxlength="255" col="col-sm-4 mt-5" name="email"
                              label="{{ trans('app.email') }}"/>
                <x-form.text-area  :bootstrap-max-length="true" maxlength="255" col="col-12 mt-5 " name="description"
                                   label="{{ trans('app.description') }}"/>


            </div>

            <div class="col-12 mt-5">
                <x-form.button/>
            </div>


        </x-form.form>

    @endcomponent
@endsection
