<div class="{{ $col }}">
    <div class="fv-row mt-5">
        <label class="fs-6 fw-semibold mb-2 @if($required || $attributes->has('required')) required @endif ">
            {{ $label }}
            <i class="fas fa-exclamation-circle ms-2 fs-7"
               @if(!empty($tooltip)) data-bs-toggle="tooltip" aria-label="{{ $tooltip }}" data-bs-original-title="{{ $tooltip }}" @endif
            ></i>
        </label>

        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-1 row-cols-xl-3 g-9" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']" data-kt-initialized="1">
            @if(isCleanArray($radios))
                @foreach($radios as $radio)
                    @php
                        $_id = $id();
                    @endphp
                    <div class="col">
                        <div class="form-check form-check-custom form-check-solid">

                            <input
                                @if($required || $attributes->has('required')) required @endif
                            @if($readonly || $attributes->has('readonly')) readonly @endif
                            @if($isRadioChecked($radio['value'])) checked @endif
                            name="{{ $name }}" value="{{ $radio['value'] }}"
                                class="form-check-input"
                                type="radio"
                                id="{{ $_id }}"
                            />
                            <label class="form-check-label" for="{{ $_id }}">
                                {{ $radio['label'] }}
                            </label>
                        </div>
                    </div>

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
