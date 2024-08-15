$('.needs-validations').each(function (i, form) {
    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {

            $(form).find("[data-control='select2']").each(function () {
                let $this = $(this);
                selectValidation($this)
                $this.on('change', function () {
                    selectValidation($this)
                })
            });

            $(form).find(".form-control-date").each(function () {
                let $this = $(this);
                inputDateValidation($this);
                $this.on('change', function () {
                    console.log($this.val())
                    inputDateValidation($this)
                })
            });

            event.preventDefault()
            event.stopPropagation()
        }
        form.classList.add('was-validated')
    }, false)
});
$('span[data-kt-image-input-action="remove"]').on('click', function () {
    console.log('fdsfg')
    console.log($(this).closest('.image-input').find('#hidden-path'))
    $(this).closest('.image-input').find('#hidden-path').val(null);
});

var showMoreTextModalEl = $('#component_show-more');
$('.show-more-text').on('click', function () {
    let $this = $(this);
    showMoreTextModalEl.find('.modal-body').html(`
                   <p style="word-break: break-word" ">
                        ${$this.closest('.show-more-wrapper').attr('data-show-more')}
                    </p>
                     `);
    showMoreTextModalEl.modal('toggle');
});
$('.bootstrap-maxlength').each(function () {
    $('#' + $(this).attr('id')).maxlength({
        threshold: 20,
        warningClass: "badge badge-primary",
        limitReachedClass: "badge badge-success"
    });
});


function selectValidation(element) {

    let select2 = element.siblings(".select2-container").find('.select2-selection');
    if (element.prop('required') && element.val() == "") {

        select2.addClass("is-invalid")
        select2.removeClass("is-valid")
    } else {
        select2.removeClass("is-invalid")
        select2.addClass("is-valid")
    }
}

function inputDateValidation(element) {
    if (element.prop('required') && element.val() == "") {
        element.siblings(".form-control-date").addClass("is-invalid")
        element.siblings(".form-control-date").removeClass("is-valid")
    } else {
        console.log(element)
        element.siblings(".form-control-date").removeClass("is-invalid")
        element.siblings(".form-control-date").addClass("is-valid")
    }
}
