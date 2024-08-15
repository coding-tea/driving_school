<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

@if (app()->getLocale() == 'ar')
    <style>
        html * {
            direction: rtl;
        }
    </style>
    <link href="{{ asset('assets/css/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css">
@else
    <link href="{{ asset('assets/css/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
@endif

<style>
    .app-sidebar-primary {
        /* background-color: #578070; */
        /* color: white; */
        /* border-right: 1px solid rgba(255, 255, 255, .15); */
    }

    .app-sidebar-secondary, #kt_app_sidebar {
        /* display: none; */
        /* background-color: #578070; */
        /* color: white; */
    }

    #kt_app_header{
        background-color: #1e6a75;
    }
</style>

@vite(['resources/css/app.css', 'resources/js/app.js'])


@stack('style')
