<div class="{{ $col }}">

    <div class="d-flex flex-column">
        @if($showLabele)
            <div class="">
                <label class="form-label" for="{{$id()}}">{{ $label }}</label>
                @if($required || $attributes->has('required'))
                    <x-helpers.forms.required/>
                @endif
                @if($readonly || $attributes->has('readonly'))
                    <x-helpers.forms.readonly/>
                @endif
            </div>
        @endif
        <div class="">
            <div class="image-input image-input-outline"
                 data-kt-image-input="true"
                 style="background-image: url({{ asset('assets/media/default/image-placeholder.png') }})">
                <!--begin::Image preview wrapper-->
                <div class="image-input-wrapper w-125px h-125px"
                     style="background-image: url({{   empty($value) ?  asset('assets/media/default/image-placeholder.png') : $value}})"></div>
                <!--end::Image preview wrapper-->

                <!--begin::Edit button-->
                <label
                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="change"
                    data-bs-toggle="tooltip"
                    data-bs-dismiss="click"
                    title="Change avatar">
                    <i class="bi bi-pencil-fill fs-7"></i>

                    <!--begin::Inputs-->
                    <input type="file" name="{{ $name }}" accept=".png, .jpg, .jpeg"/>
                    <input type="hidden" name="avatar_remove"/>
                    <input type="hidden" id="hidden-path" name="{{ $generateNameForInputFileImgPreview() }}"
                           value="{{ $value }}"/>

                    <!--end::Inputs-->
                </label>
                <!--end::Edit button-->

                <!--begin::Cancel button-->
                <span
                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="cancel"
                    data-bs-toggle="tooltip"
                    data-bs-dismiss="click"
                    title="Cancel avatar">
        <i class="bi bi-x fs-2"></i>
    </span>
                <!--end::Cancel button-->

                <!--begin::Remove button-->
                <span
                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="remove"
                    data-bs-toggle="tooltip"
                    data-bs-dismiss="click"
                    title="Remove avatar">
        <i class="bi bi-x fs-2"></i>
    </span>
                <!--end::Remove button-->
            </div>
        </div>

    </div>


    <x-helpers.error
        name="{{ $name }}"
    />

</div>
@push('scripts')
    <script>
        $('[name="{{ $name }}"]').on('change', function () {
            setTimeout(() => {
                $('[name={{ $generateNameForInputFileImgPreview() }}]').val(
                    $('.image-input-wrapper').css('background-image').replace(/(url\(|\)|")/g, '')
                )
            }, 300);

        });
    </script>
@endpush
