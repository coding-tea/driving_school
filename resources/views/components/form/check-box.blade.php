<div class="col">
    <div class="form-check form-check-custom form-check-solid">
        <input
            {!! $attributes->merge(['class' => 'form-check-input ']) !!}
            {!! $attributes->except('class') !!}
            @if($required || $attributes->has('required')) required @endif
            @if($readonly || $attributes->has('readonly')) readonly @endif
            name="{{ $name }}"
            type="checkbox"
            value="{{ $value }}"
            id="{{ $id() }}"
            @if($checked)
                checked="checked"
            @endif
        />
        <label class="form-check-label @if( !$multi && $required || $attributes->has('required')) required @endif " for="{{$id()}}">
            {{ $label }}
        </label>
        <span class="invalid-feedback d-block">

        @if($showError)
                @error($name)
                {{ $message }}
                @enderror
            @endif
    </span>

    </div>
</div>
