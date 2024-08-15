<div class="edit-consult-group {{ $col }}">

    @if($showLabele)
        <label

            class="form-label"
            for="{{$id()}}">{{ $label }}</label>

        @if($required || $attributes->has('required'))
            <x-helpers.forms.required/>

        @endif

        @if($readonly || $attributes->has('readonly'))
           <x-helpers.forms.readonly/>
        @endif
    @endif
    <input

        type="{{ $type }}"
        value='{{ $value }}'
        id="{{ $id() }}"
        name="{{ $name }}"
        {{ $required ? 'required'  : '' }}
        {{ $readonly ? 'readonly'  : '' }}
        {{$attributes->merge(['class' => 'form-control ' . ($bootstrapMaxLength  ? 'bootstrap-maxlength' : '' ) . ($readonly ? 'form-control-solid' : '')])}}
        @if($placeholder !== false) placeholder='{{ $placeholder  }}' @endif

    />

    <x-helpers.error name="{{ $name }}"/>


</div>


{{--<div class="form-group row">--}}
{{--    @if(!empty($label))--}}
{{--        <label--}}
{{--            class="@if($horizontal) col-12 col-sm-3 @else col-12 @endif text-dark  col-form-label"--}}
{{--               class='form-label'--}}
{{--            style="font-size:16px "--}}
{{--            for={{ $id()  }}--}}
{{--        >--}}
{{--            {{ ucfirst($label) }}--}}
{{--            @if($required || $attributes->has('required'))--}}
{{--                <span class="text-danger">*</span>--}}
{{--            @endif--}}
{{--        </label>--}}


{{--    @endif--}}


{{--    <div class=" @if($horizontal) col-12 col-sm-9 @else col-12  @endif "  @if($horizontal === false) style="margin-top: -15px" @endif  >--}}
{{--        <div class="input-group mb-3">--}}

{{--            <input--}}
{{--                {{ $required ? 'required'  : '' }}--}}
{{--                {{ $readonly ? 'readonly'  : '' }}--}}
{{--                {{$attributes->merge(['class' => 'form-control '])}}--}}
{{--                type='{{ $type }}'--}}
{{--                id='{{ $id() }}'--}}
{{--                name='{{ $name }}'--}}
{{--                value='{{ $value }}'--}}
{{--                @if($placeholder !== false) placeholder='{{ $placeholder  }}' @endif--}}
{{--                {!! $attributes !!}--}}
{{--            >--}}
{{--            @if(isset($button))--}}
{{--                {!! $button !!}--}}
{{--            @endif--}}

{{--        </div>--}}

{{--        <span class="invalid-feedback d-block">--}}
{{--        @error($name)--}}
{{--            {{ $message }}--}}
{{--            @enderror--}}
{{--        </span>--}}


{{--           @if(isset($html) && is_array($html) && count($html))--}}
{{--            {!! $html['content'] !!}--}}
{{--        @endif--}}
{{--    </div>--}}


{{--</div>--}}
