<button class="card hover-elevate-up shadow-sm parent-hover">
    <div class="card-body d-flex align-items">
        {{-- <span class="svg-icon fs-1">
            {!! $icon !!}
        </span> --}}

        <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold">
            {{ $slot }}
        </span>
    </div>
</button>