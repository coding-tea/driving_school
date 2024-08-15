@extends('layouts.app')
@include('components.edition')


@section('content')
    <div class="row">
      <div class="col-4 row">
          <div class="col-12">
              @component('components.group.card')
                  @slot('title' , 'Roles')

                  <div class="d-flex flex-column text-gray-600">
                      @foreach($userRoles as $userRole)
                          <div class="d-flex align-items-center py-2">
                              <span class="bullet bg-{{ \App\Enums\UserRole::tryFrom( $userRole->name)->class() }} me-3"></span>
                              {{ $userRole->name }}
                          </div>
                      @endforeach

                  </div>

              @endcomponent
                  @component('components.group.card')
                      @slot('title' , 'Permissions')

                      <div class="d-flex flex-column text-gray-600">
                          @foreach($userPermissions as $userPermission)
                              <div class="d-flex align-items-center py-2">
                                  <span class="bullet bg-primary me-3"></span>
                                  {{ $userPermission->name }}
                              </div>
                          @endforeach
                      </div>

                  @endcomponent
          </div>
      </div>
        <div class="col-8">
            @component('components.group.card')
                @slot('title' , $pageTitle)

                @bind($user)
                <x-form.form
                    method="post"
                    class="row"
                    action="{{ route('users.update' , $user) }}"
                >


                    <div class="col-12 pb-5">
                        <x-form.file :src="$user->getImagePath()" required name="image" label="{{ trans('app.avatar') }}"/>
                    </div>
                    <div class="col-12  row">
                        <x-form.input required :bootstrap-max-length="true" maxlength="255" col="col-sm-3"
                                      name="first_name"
                                      label="{{ trans('app.first_name') }}"/>
                        <x-form.input required :bootstrap-max-length="true" maxlength="255" col="col-sm-3"
                                      name="last_name"
                                      label="{{ trans('app.last_name') }}"/>


                        <x-form.input required :bootstrap-max-length="true" maxlength="255" col="col-sm-3" name="cin"
                                      label="{{ trans('app.cin') }}"/>


                        <x-form.input required :bootstrap-max-length="true" maxlength="255" col="col-sm-3"
                                      name="phone_number"
                                      label="{{ trans('app.phone_number') }}"/>

                        <x-form.select col="col-12 col-sm-3"
                                       name="gender"
                                       label="{{ trans('app.gender') }}"
                                       :options="\App\Enums\Gender::toArray()"
                        />


                        <x-form.select col="col-12 col-sm-3 mt-5"
                                       name="civility"
                                       label="{{ trans('app.civility') }}"
                                       :options="\App\Enums\Civility::toArray()"
                        />

                        <x-form.select col="col-12 col-sm-3 mt-5"
                                       name="city"
                                       label="{{ trans('app.city') }}"
                                       :bind-with="$cities"
                        />


                        <x-form.input-date required col="col-sm-3 mt-5" name="dob"
                                           label="{{ trans('app.dob') }}"/>

                        <x-form.input required :bootstrap-max-length="true" maxlength="255" col="col-sm-3 mt-5"
                                      name="email"
                                      label="{{ trans('app.email') }}"/>


                        <x-form.text-area :bootstrap-max-length="true" maxlength="255" col="col-12 mt-5 "
                                          name="description"
                                          label="{{ trans('app.description') }}"/>


                    </div>


                    <div class="col-12 mt-5">
                        <x-form.button/>
                    </div>


                </x-form.form>


                @endBinding
            @endcomponent
        </div>
    </div>

@endsection
