
<div class="edit-consult-group {{ $col }}">
    @if($showLabele)
     <label class="form-label" for="{{$id()}}">{{ $label }}</label>
        @if($required || $attributes->has('required'))
            <x-helpers.forms.required/>

        @endif

        @if($readonly || $attributes->has('readonly'))
            <x-helpers.forms.readonly/>
        @endif
    @endif
    <input

        type="date"
        id="{{ $id() }}"
        name="{{ $name }}"
        value='{{ $value }}'
        {{ $required ? 'required'  : '' }}
        {{ $readonly ? 'readonly'  : '' }}
        {{$attributes->merge(['class' => 'form-control form-control-date '])}}
    />
        <x-helpers.error  name="{{ $name }}"/>

</div>


@push('script')
    <script>
        @php
            $format = match ($pickerType){
                \App\View\Components\Form\InputDate::DATETIME => 'Y-m-d H:i:s',
                \App\View\Components\Form\InputDate::TIME => 'H:i:s',
                default => 'Y-m-d'
            }
        @endphp
       let fdfds =  $("#{{  $id() }}").flatpickr({
            enableTime: @if($pickerType == \App\View\Components\Form\InputDate::TIME || $pickerType == \App\View\Components\Form\InputDate::DATETIME ) true @else false @endif,
            noCalendar: @if($pickerType == \App\View\Components\Form\InputDate::TIME) true @else false @endif,
            dateFormat: "{{ $format }}",
            altInput: true,

        });
        fdfds._input.onkeypress = () => false;
    </script>
@endpush
