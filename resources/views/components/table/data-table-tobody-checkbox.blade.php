@props(['id' => null])
<td {!! $attributes !!}>
    <div class="form-check form-check-sm form-check-custom form-check-solid">
        <input class="form-check-input "
               type="checkbox" value="{{ $id }}" />
    </div>
</td>
