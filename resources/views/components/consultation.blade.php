

@push('script')
    <script src="{{ asset('assets/plugins/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/fslightbox/fslightbox.bundle.js') }}"></script>
    <script src="https://bartaz.github.io/sandbox.js/jquery.highlight.js"></script>
@endpush
@push('style')
    <link href="{{ asset('assets/plugins/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <style>
        .highlight{
            position: inherit !important;
            background: yellow !important;
            border-radius: inherit !important;
            padding: 0 !important;
            font-size: 17px !important;
        }
    </style>
@endpush
@vite(pageJs('components/consultation'))
