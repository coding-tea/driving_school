
<div class=" edit-consult-group {{ $col }}">
    @if($showLabele)

        <label class="form-label" for="{{$id()}}">{{ $label }}</label>
        @if($required || $attributes->has('required'))
            <x-helpers.forms.required/>

        @endif

        @if($readonly || $attributes->has('readonly'))
            <x-helpers.forms.readonly/>
        @endif
    @endif
    <select
        data-control="select2"
        @if($disabled) disabled @endif
        @if($required || $attributes->has('required')) required @endif
        @if($readonly || $attributes->has('readonly')) readonly @endif
        id="{{ $name }}"
    name="{{ $name }}"
       @if($attributes->has('multiple'))  multiple="multiple" @endif class="form-select  {{ $attributes->get('class') }}"{!! $attributes->except(['multiple', 'class' , 'required' , 'readonly']) !!}>
        <option value="">{{ trans('app.components.select.select_option') }}</option>
        @if(isset($options))
            @foreach($options as $key => $option)
                @if($isModelExists() &&  old($name))
                    <option
                        {{ old($name) === $key ? 'selected' : '' }}  value={{$key}}>{{ $option }}</option>
                @else
                    @if($isModelExists())
                        <option
                            {{ $column() == $key ? 'selected' : '' }}  value={{$key}}>{{ $option }}</option>
                    @elseif( old($name)  )
                        <option
                            {{ old($name) === $key ? 'selected' : '' }}  value={{$key}}>{{ $option }}</option>
                    @else
                        <option value={{$key}} >{{ $option }}</option>
                    @endif
                @endif

            @endforeach
        @elseif(isset($table))
            @php($columns = $table[1])
            @if( $table[0] instanceof \Illuminate\Support\Collection || is_array($table[0])  && count($table[0]))
                @foreach($table[0] as $record)

                    @if($isModelExists() && old($name))
                        <option
                            {{ old($name) == $record[$columns[0]] ? 'selected' : '' }}
                            value="{{$record[$columns[0]]}}">   {{ $getPipeline($columns[1],$record , $columns[2] ?? null) }}   </option>
                    @else
                        @if($isModelExists())
                            <option
                                {{ $column() == $record[$columns[0]] ? 'selected' : '' }}
                                value="{{$record[$columns[0]]}}">   {{ $getPipeline($columns[1],$record , $columns[2] ?? null) }}   </option>
                        @elseif( old($name) !== null )
                            <option
                                {{ old($name) == $record[$columns[0]]  ? 'selected' : '' }}
                                value="{{$record[$columns[0]]}}">   {{ $getPipeline($columns[1],$record , $columns[2] ?? null) }}   </option>
                        @else
                            <option
                                value="{{$record[$columns[0]]}}">   {{ $getPipeline($columns[1],$record , $columns[2] ?? null) }}   </option>
                        @endif
                    @endif
                @endforeach
            @endif

        @endif
    </select>
    <x-helpers.error  name="{{ $name }}"/>
</div>
