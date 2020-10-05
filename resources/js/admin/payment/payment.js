var $ = require( "jquery" );

$(document).ready(function () {

    $("#sponsorship_select").change(function () {

        var price = $(this).find(':selected').data("price");
        $('#amount').val(price);
    });
});
