$('[mrx-dt="true"]').each(function () {
    console.log(window.mrx.tools.getDtIntsance('[data-table-identifier="export"]'))
        const _datatable = window.mrx.tools.getDtIntsance('[data-table-identifier="export"]');
        let dataTableContainer = $(_datatable.table().container())
        $(document).on('change', 'thead input', function () {
            dataTableContainer.find('tbody td input[type=checkbox]').prop("checked", $(this).prop("checked"));
        });
        let ids = [];
        $('[app-dt-action-href-export]').on('click',function (e) {
                e.preventDefault();

                window.href = $(this).attr("app-dt-action-href-export");

            _datatable.rows({search: 'applied'})
                    .iterator('row', function (context, index)
                        {
                            let node = $(this.row(index).node());
                            ids.push(node.find('input[type=checkbox]').val());
                        }
                    );






                axios.post(window.href, {
                    'ids': ids,
                })
                    .then(function (response) {
                        ids = [];



                        if(response.data.path !== undefined){
                            console.log(response.data.path);
                            location.href = response.data.path;
                        }else{
                            Swal.fire({
                                text: "There is a problem. We will cancel the operation",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok",
                                customClass: {
                                    confirmButton: "btn btn-danger"
                                }
                            });
                        }


                    })
                    .catch(function (error) {
                        console.log(error.response.data);

                    });
            });

});
$('[app-model-action-href]').on('click',function (e) {
    e.preventDefault();

    window.href = $(this).attr("app-model-action-href");

    axios.post(window.href, {
        'ids': [],
    })
        .then(function (response) {
            if(response.data.path !== undefined){
                console.log(response.data.path);
                location.href = response.data.path;
            }else{
                Swal.fire({
                    text: "There is a problem. We will cancel the operation",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok",
                    customClass: {
                        confirmButton: "btn btn-danger"
                    }
                });
            }


        })
        .catch(function (error) {
            console.log(error.response.data);

        });
});
