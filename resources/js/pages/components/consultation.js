window.mrx = {
    tools: {

        generateDataTable(elm) {
            console.log(this.getDtLang())
            const configs = {
                "language": {
                    'url': this.getDtLang(),
                },
                "info": false,
                "bLengthChange": true, //thought this line could hide the LengthMenu
                "bInfo": true,
                'order': [],
                'dom': '<"pull-right">rt<"row"<"col-sm-4"l><"col-sm-4"i><"col-sm-4"p>>',
                // 'bFilter': false,
                'pageLength': 10,
                "lengthMenu": [[5, 10, 15, 20], [5, 10, 15, 20, "All"]],
                "columnDefs": [
                    {
                        targets: 'no-sort', orderable: false, "order": []
                    }

                ],


            };



            if (elm instanceof jQuery) {
                let x = elm.DataTable(configs);
                x.buttons().remove()
                return x;
            } else {
                let x = $(elm).DataTable(configs);
                x.buttons().remove()
                return x;
            }

        },
        jsDataTable(
            elm,
            inputSearchEl,
            inputCheckAllId,
            inputCheck,
            deleteRowClass,
            deleteAllRowsClass,
        ) {
            const datatable = window.mrx.tools.generateDataTable(elm);
            console.log(datatable)
            $(inputSearchEl).keyup(function () {
                datatable.search($(this).val()).draw();
            });
            $(inputCheckAllId).on('click', function () {
                $(this).closest('table').find('tbody ' + inputCheck).prop("checked", $(this).prop("checked"));
            });


            $(deleteRowClass).on('click', function (e) {
                e.preventDefault();
                console.log($(deleteRowClass))
                var href = $(this).attr('href');
                Swal.fire({
                    title: Lang.get('messages.sure_message'),
                    text: Lang.get('messages.confirm_delete_message'),
                    icon: 'warning',

                    showCancelButton: true,
                    cancelButtonText: Lang.get('app.close'),
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: Lang.get('app.confirm'),
                })
                    .then(function (result) {
                        if (result.value) {
                            location.href = href;
                        }
                    });
            });
            $(deleteAllRowsClass).on('click', function (e) {
                e.preventDefault();
                window.ids = [];

                window.href = $(this).attr("app-dt-action-href");


                $(inputCheck + ":checked").each(function () {
                        window.ids.push($(this).prop("value"));
                    }
                );


                if (window.ids.length) {
                    console.log(Lang.get('messages.sure_message'))
                    Swal.fire({
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        title: Lang.get('messages.sure_message'),
                        text: Lang.get('messages.confirm_delete_message'),
                        icon: 'warning',
                        cancelButtonText: Lang.get('app.close'),
                        showCancelButton: true,
                        confirmButtonText: Lang.get('app.confirm'),
                    })
                        .then(function (result) {
                            if (result.value) {
                                axios.post(window.href, {
                                    'ids': window.ids,
                                })
                                    .then(function (response) {
                                        location.reload();
                                    })
                                    .catch(function (error) {
                                        console.log(error.response.data)
                                    });
                            }
                        });
                }
            });

        },
        getComponentDtIntsance(identifire) {
            return this.getDtIntsance(`[mrx-dt-id=${identifire}]`);
        },
        getDtIntsance(selector) {
            return new $.fn.dataTable.Api(selector);
        },
        getDtLang() {
            switch ($('html').attr('lang')) {
                case 'ar' :
                    return '//cdn.datatables.net/plug-ins/1.13.7/i18n/ar.json';
                case 'fr' :
                    return '//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json';
                case 'en' :
                    return "//cdn.datatables.net/plug-ins/1.13.7/i18n/en-GB.json";
            }
        }
    }
};
$('[mrx-dt="true" ]').each(function () {
    let $this = $(this);
    let dtContainer = $(this).closest('.dt-container');
    let dataTable = window.mrx.tools.generateDataTable('#' + $this.attr('id'));

    dataTable.on('draw', function () {
        const body = $(dataTable.table().body());

        body.unhighlight();
        body.highlight(dataTable.search());
    });


    $(`[mrx-dt-search="${$this.attr('id')}"]`).on('keyup', function () {
        console.log($(this).val());
        dataTable.search($(this).val()).draw();
    });

    $this.find('thead  input[type=checkbox]').on('change', function () {
        $this.find('tbody input[type=checkbox]').prop("checked", $(this).prop("checked"));
    });

    $this.find('.delete-record').on('click', function (e) {
        var href = $(this).attr('href');
        e.preventDefault();
        Swal.fire({
            customClass: {
                confirmButton: "btn btn-danger",
                cancelButton: "btn btn-light"
            },

            title: Lang.get('messages.sure_message'),
            text: Lang.get('messages.confirm_delete_message'),

            icon: 'warning',
            cancelButtonText: Lang.get('app.cancel'),
            showCancelButton: true,
            confirmButtonText: Lang.get('app.delete'),
        })
            .then(function (result) {
                if (result.value) {
                    location.href = href;
                }
            });
    });


    dtContainer.find('.delete-selected-rows').on('click', function (e) {


        console.log("clicked")

        e.preventDefault();


        window.ids = [];

        window.href = $(this).attr("app-dt-action-href");


        $this.find('tbody input[type=checkbox]:checked').each(function () {
                window.ids.push($(this).prop("value"));
            }
        );


        if (window.ids.length) {
            Swal.fire({
                customClass: {
                    confirmButton: "btn btn-danger",
                    cancelButton: "btn btn-light"
                },

                title: Lang.get('messages.sure_message'),
                text: Lang.get('messages.confirm_delete_message'),

                icon: 'warning',
                cancelButtonText: Lang.get('app.cancel'),
                showCancelButton: true,
                confirmButtonText: Lang.get('app.delete'),
            })
                .then(function (result) {
                    if (result.value) {
                        axios.post(window.href, {
                            'ids': window.ids,
                        })
                            .then(function (response) {
                                location.reload();
                            })
                            .catch(function (error) {
                                console.log(error.response.data.message
                                )
                            });
                    }
                });
        } else {
            Swal.fire({
                text: "Here's a basic example of SweetAlert!",
                icon: "info",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn btn-info"
                }
            });
        }
    });

});
