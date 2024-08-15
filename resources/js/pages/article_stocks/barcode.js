$(document).ready(function () {
    var translations = $("#translations");
    $('[data-toggle="popover"]').popover({
        placement: "top",
        trigger: "hover",
        html: true,
        content: function () {
            var container = $("<div></div>");
            var error_content = translations.data("error");
            var error =
                '<span class="text-danger">' + error_content + "</span>";
            var svgElement = $('<svg id="barcodeSvg"></svg>');

            var inputValue = $("#barcode_text").val();
            if (inputValue) {
                JsBarcode(svgElement[0], inputValue, {
                    format: "CODE128",
                });
                container.append(svgElement);
            } else {
                container.append(error);
            }
            return container;
        },
    });
});
