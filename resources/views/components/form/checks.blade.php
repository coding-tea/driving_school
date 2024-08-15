<div class="{{ $col }}">
    <div class="fv-row mt-5">
        <label class="fs-6 fw-semibold mb-2 @if($required || $attributes->has('required')) required @endif ">
            {{ $label }}
            <i class="fas fa-exclamation-circle ms-2 fs-7"
               @if(!empty($tooltip)) data-bs-toggle="tooltip" aria-label="{{ $tooltip }}"
               data-bs-original-title="{{ $tooltip }}" @endif
            ></i>
        </label>

        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-1 row-cols-xl-3 g-9" data-kt-buttons="true"
             data-kt-buttons-target="[data-kt-button='true']" data-kt-initialized="1">
            @if(isCleanArray($checks))
                @foreach($checks as $checkbox)
                    <x-form.check-box
                        name="{{ $name }}"
                        label="{{ $checkbox['label'] }}"
                        value="{{ $checkbox['value'] }}"
                        :multi="true"
                        :show-error="false"
                        :required=" $required || $attributes->has('required')"
                        :readonly=" $readonly || $attributes->has('readonly')"

                    />
                @endforeach

            @endif
        </div>
        <span class="invalid-feedback d-block">
           @error($name)
            {{ $message }}
            @enderror
        </span>

    </div>
</div>
