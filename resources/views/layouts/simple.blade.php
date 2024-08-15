@extends('layouts.base')

@section('body')

    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            @yield('content')
        </div>
    </div>
@endsection
