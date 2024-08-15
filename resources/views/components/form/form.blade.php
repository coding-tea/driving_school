<form
    class="form fv-plugins-bootstrap5 fv-plugins-framework row needs-validations"
    action="{{ $action }}"
    novalidate
    id="{{ $id() }}"
    method="{{ $method }}"
    enctype="multipart/form-data"
>
    @csrf
    {!! $slot !!}
</form>

