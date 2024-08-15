@props(['id' => null])
<tr mrx-dt-id="{{ $id }}">
    <x-table.data-table-tobody-checkbox />

    <td class="d-flex align-items-center">

        <a class="d-block overlay" data-fslightbox="lightbox-basic"
           href="{{ stream_image_from_uploads($user->getImagePath()) }}">
            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                <div class="symbol-label">
                    <img src="{{ stream_image_from_uploads($user->getImagePath()) }}"
                         alt="Emma Smith" class="w-100">
                </div>
            </div>


            <div class="d-flex flex-column">
                <a class="text-gray-800 text-hover-primary mb-1">

                    <a class="text-gray-800 text-hover-primary mb-1"
                       href="{{ route('users.show' , $user) }}">
                        {{ $user->dto()->fullname()}}
                    </a>
                </a>
                <span>
                                            {{ $user->email }}
                                        </span>
            </div>
        </a>
    </td>
    <td>
        {{ $user->dto()->cin }}
    </td>
    <td>
        {{ $user->dto()->description }}
    </td>
    <td>
        {{ $user->dto()->dbo() }}

    </td>
    <td>


        {!! $user->dto()->genderAsEnum()->icon() !!}
        {{--                                {{ $user->dto()->genderAsEnum()->text() }}--}}
    </td>
    <td>
        {{ $user->dto()->civilityAsEnum()->text() }}
    </td>
    <td>
        {{ $user->getCity->name }}
    </td>
    <td>
        <div class="badge  badge-light-{{$user->dto()->statusAsEnum()->class() }} fw-bold">
            {{ $user->dto()->statusAsEnum()->text() }}
        </div>
    </td>
    <td>
        @foreach($user->roles as $role)
            <div
                class="badge badge-light-{{ \App\Enums\UserRole::tryFrom($role->name)->class()  }} fw-bold">
                {{ \App\Enums\UserRole::tryFrom($role->name)->label() }}
            </div>
        @endforeach
    </td>
    <td class="text-end">
        <a href="#"
           class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
           data-kt-menu-trigger="click"
           data-kt-menu-placement="bottom-end">{{ trans('app.actions') }}
            <i class="ki-outline ki-down fs-5 ms-1"></i>
        </a>

        <div
            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
            data-kt-menu="true">

            <div class="menu-item px-3">
                <a href="{{ route('users.show' , $user) }}"
                   class="menu-link px-3">{{ trans('app.edit') }}</a>
            </div>


            <div class="menu-item px-3">
                <a href="{{ route('users.destroy' , $user) }}"
                   class="menu-link px-3"
                   data-kt-users-table-filter="delete_row">{{ trans('app.delete') }}</a>
            </div>


            <div class="menu-item px-3"
                 data-kt-menu-trigger="hover"
                 data-kt-menu-placement="right-end">
                <a href="#" class="menu-link px-3">
                                            <span class="menu-title">
                                                {{ trans('app.status') }}
                                            </span>
                    <span class="menu-arrow"></span>
                </a>


                <div class="menu-sub menu-sub-dropdown w-175px py-4" style="">

                    @foreach(\App\Enums\Status::cases() as $case)
                        <div class="menu-item px-3">
                            @if($user->dto()->statusAsEnum() == $case )
                                <span class="menu-link text-white px-3 bg-{{ $case->class() }}">
                                                             {{ $case->text() }}
                                                        </span>
                            @else
                                <a href="{{ route('users.updateStatus' , [$user , $case->value]) }}"
                                   class="menu-link  px-3">
                                    {{ $case->text() }}
                                </a>
                            @endif

                        </div>
                    @endforeach


                </div>

            </div>
            <div class="menu-item px-3"
                 data-kt-menu-trigger="hover"
                 data-kt-menu-placement="right-end">
                <a href="#" class="menu-link px-3">
                                            <span class="menu-title">
                                                {{ trans('app.role') }}
                                            </span>
                    <span class="menu-arrow"></span>
                </a>


                <div class="menu-sub menu-sub-dropdown w-175px py-4" style="">

                    @foreach(\App\Enums\UserRole::cases() as $case)
                        <div class="menu-item px-3">
                            @if( $user->hasRole($case) )
                                <span class="menu-link text-white px-3 bg-{{ $case->class() }}">
                                                             {{ $case->label() }}
                                                        </span>
                            @else
                                <a href="{{ route('users.updateRole' , [$user , $case->value]) }}"
                                   class="menu-link  px-3">
                                    {{ $case->label() }}
                                </a>
                            @endif

                        </div>
                    @endforeach


                </div>

            </div>

            @hasrole(\App\Enums\UserRole::SUPER_ADMIN->value)
            <div class="menu-item px-3">
                <a href="{{ route('users.resetPassword' , $user) }}"
                   class="menu-link px-3"
                   data-kt-users-table-filter="delete_row">{{ trans('auth.reset_password') }}</a>
            </div>
            @endhasrole

        </div>

    </td>
</tr>
