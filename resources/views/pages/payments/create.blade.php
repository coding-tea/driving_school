@extends('layouts.app')
@include('components.consultation')

@section('content')
    @component('components.group.card')
        @slot('title', '¨Payments')
        <x-form.form method="post" action="{{ route('payments.store') }}">

            <div class="col-12 col-sm-12 mt-5">
                <label for="profil_id" class="form-label"> {{ trans('cars.profil_id') }} </label>
                <select class="form-select" id="profil_id" data-control="select2" data-placeholder="Select an option"
                    name="profil_id" id="user_id">
                    <option></option>
                    @foreach (\App\Models\Profile::all() as $item)
                        <option value="{{ $item->id }}"> {{ $item->name }} </option>
                    @endforeach
                </select>
            </div>

            <x-form.input required col="col-12 col-sm-12 mt-5" name="amount" label="{{ trans('cars.amount') }}" />

            <x-form.input-date required col="col-12 col-sm-12 mt-5" name="date" label="{{ trans('cars.date') }}" />

            <div class="col-12 mt-5">
                <x-form.button />
            </div>

        </x-form.form>
    @endcomponent

@endsection
