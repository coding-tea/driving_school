let jsonResponse = $('meta[name="alert"]').attr('content');


if( jsonResponse != null && jsonResponse != undefined ){
    let $alertObj = JSON.parse(jsonResponse);
    Swal.fire({
        text: $alertObj.text,
        title: $alertObj.title,
        icon: $alertObj.icon,
        buttonsStyling: false,
        confirmButtonText: Lang.get('app.done'),
        customClass: {
            confirmButton: "btn btn-primary"
        }
    });
}
