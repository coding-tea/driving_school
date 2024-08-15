<div class='form-group row'>

    <label sty class="@if($horizontal) col-12 col-sm-3 @else col-12 @endif col-3 text-dark  col-form-label"
           class='form-label' style="font-size:16px ">
        {{ ucfirst($label) }}
        @if($required || $attributes->has('required'))
            <span class="text-danger">*</span>
        @endif
    </label>


    <div class="@if($horizontal) col-12 col-sm-9 @else col-12 @endif ">
        <div class="layout-spacing pb-0 mx-3">
            <div class="row  options" minimum-selection="{{ $min }}">
                {{ $slot }}
            </div>
            <span class="invalid-feedback d-block">
                @error($name)
                {{ $message }}
                @enderror
        </span>
        </div>
    </div>
</div>


@push('custom-scripts')
    <script>
        @if($required)
        $('input[name="{{$name}}"] , input[type="checkbox"]').attr('required', true);
        @endif

        @if($readonly)
        var condition = setInterval(() => {
            let inputRadio = $('input[name="{{$name}}"]');

            if (inputRadio.length) {
                inputRadio.attr('disabled', true);
                clearInterval(condition);
            }
        }, 500);
        @endif

    </script>
@endpush




