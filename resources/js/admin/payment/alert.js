var $ = require( "jquery" );

$( document ).ready(function() {

    $( "#alert" ).attr( "data-toggle", "modal" );
    $("#alert")[0].click();

});
