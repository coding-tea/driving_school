const optionFormat = (item) => {
    if (!item.id) {
        return item.text;
    }
    let selectOptionEl = $(item.element);

    return $(`
               <span>
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-30px symbol-md-40px me-5">
                              <img src="${selectOptionEl.attr('data-img')}" alt="image">
                        </div>
                        <div class="d-flex flex-column">
                            <span class="fs-7 fw-bolder lh-1 text-wrap">${selectOptionEl.attr('data-name')}</span>
                            <span class="text-muted fs-8">${selectOptionEl.attr('data-name-abrg')}</span>
                        </div>
                    </div>
               </span>
            `);
}

$('#kt_docs_select2_rich_content').select2({
    // minimumResultsForSearch: function (e) {
    //     console.log(e)
    // },

    templateSelection: optionFormat,
    templateResult: optionFormat
});
$('#kt_docs_select2_rich_content').on('change' , function (){
    location.href = $(this).val();
})



$('[name="notifications"]').on('change', function () {

    $('.navbar-app-container__hided').html($('.navbar-app-link').clone());
    if (parseInt($(this).val()) === 2) {
        $('.navbar-app-container').hide()
        $('.navbar-app-container__hided').show();
    } else {
        $('.navbar-app-container__hided').hide();
        $('.navbar-app-container').show()
    }
});
