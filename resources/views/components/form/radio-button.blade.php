<div class="form-group row">
    <label
        class="col-12  text-dark  col-form-label"
        class='form-label'
        style="font-size:16px ">
        {{ $label }}
        @if($required || $attributes->has('$required'))
            <span class="text-danger">*</span>
        @endif
    </label>
    <div class="col-12">
        @if(count($radios))
            @foreach($radios as $radio)
                <div class="form-check form-check-inline">
                    @php
                        $val = $radio['value'] ?? null;
                        if(!isset($val) || empty($val)){
                            $val = strtoupper(substr($radio['label'], 0, 1));
                        }
                        $id = $generateId();
                    @endphp
                    <input class="form-check-input"  @if($isChecked($val)) checked @endif   @if($required || $attributes->has('$required')) required @endif   name="{{ $name }}" type="radio" id="{{ $id }}" value="{{ $val }}">
                    <label class="form-check-label" for="{{$id}}">{{$radio['label']}}</label>
                </div>
            @endforeach
        @endif


    </div>
</div>
