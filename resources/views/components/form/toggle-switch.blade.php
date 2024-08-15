<div class=" row">
    <div class="col-12 col-sm-3 d-table">
        <p class="h6 d-table-cell " style="vertical-align: middle; white-space: nowrap;">
            {{ $label }}
            @if($required)
                <span class="text-danger">*</span>
            @endif
        </p>

    </div>
    <div class="col-12 col-sm-9"  style="margin-top:-7px ">

        <input

            name="{{ $name }}"
            id="{{ $id() }}"
            data-onvalue="{{ $firstOptionValue }}"
            data-offvalue="{{$secondOptionValue  }}"
            type="checkbox"
            data-on="{{ $firstOptionText }}"
            data-off="{{ $secondOptionText }}"

            data-style="{{ $style }}"

            data-toggle="toggle"

            @if(isset($firstOptionColor))
                data-onstyle="{{ $firstOptionColor }}"
            @endif

            @if(isset($secondOptionColor))
                data-offstyle="{{ $secondOptionColor }}"
            @endif




            @if(isset($checked))
                checked="{{$checked}}"
            @else
                @if($firstOptionValue == $value)
                    checked
                 @endif
                     
            @endif


            @if(isset($size))
                data-size="{{ $size }}"
            @elseif(isset($customSizeHeight, $customSizewidth))
                data-height="{{ $customSizeHeight }}"
            data-width="{{ $customSizewidth }}"
            @endif

        >

    </div>
    <span class="invalid-feedback d-block">
        @error($name)
        {{ $message }}
        @enderror
        </span>
</div>
