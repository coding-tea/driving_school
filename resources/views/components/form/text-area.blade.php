<div class="edit-consult-group {{ $col }}">
    <div class="d-flex justify-content-between align-items-center">
        @if ($showLabele)

            <label class="form-label" for="{{ $id() }}">{{ $label }}
                @if ($required || $attributes->has('required'))
                    <x-helpers.forms.required />
                @endif
                @if ($readonly || $attributes->has('readonly'))
                    <x-helpers.forms.readonly />
                @endif
            </label>

        @endif
        @if ($useMic)
            <span class="voicetext btn btn-sm btn-icon" data-mic="true" data-mic-status="off"
                data-mic-target="{{ $name }}">
                <span class="voicetext-icon ">
                    <i class="voicetext-icon-microphone  fa-solid fa-microphone"></i>
                </span>
            </span>
            </span>
        @endif

    </div>
    <textarea data-app-rich="{{ $isRichText }}" style="height: 10rem" {!! $attributes->except(['class', 'is_rich']) !!}
        @if ($required || $attributes->has('required')) required @endif @if ($readonly || $attributes->has('$readonly')) readonly @endif
        name="{{ $name }}"
        {{ $attributes->merge(['class' => 'form-control  ' . ($bootstrapMaxLength ? 'bootstrap-maxlength' : '')]) }}
        placeholder="{{ $placeholder }}" id="{{ $id() }}">{{ $value }}</textarea>
    <span class="invalid-feedback d-block">
        @error($name)
            {{ $message }}
        @enderror
    </span>
</div>
