$(document).ready(function(){
	$("#resume-button").on("click", generateResumeReport );
	$("#estimate-button").on("click", generateEstimateReport );
    loadSLP();
});

function generateEstimateReport(){
    var slp_array = $("#slp").val();
    var aux_date = $("#reportrange span.hidden").text();
    aux_date = aux_date.split("&");
    var from = aux_date[0];
    var to = aux_date[1];
    var data = new Array();
    slp_array.forEach(function(e){
        data.push({ "name" : "slp_code", "value" : e});
    });
    var url = route + "/getEstimateReport?from=" + from + "&to=" + to + "&" + $.param({ slp_codes : slp_array });
    window.open( url, "_blank");
}
function generateResumeReport(){
    var slp_array = $("#slp").val();
    var aux_date = $("#reportrange span.hidden").text();
    aux_date = aux_date.split("&");
    var from = aux_date[0];
    var to = aux_date[1];
    var data = new Array();
    slp_array.forEach(function(e){
        data.push({ "name" : "slp_code", "value" : e});
    });
    var url = route + "/getResumeReport?from=" + from + "&to=" + to + "&" + $.param({ slp_codes : slp_array });
    window.open( url, "_blank");
}
function loadSLP(){
    $.ajax({
        method : "GET",
        url : getslp,
        success : function( response ){
            response.actives.forEach(function(e){
                var OPTION = $("<option></option>");
                OPTION.val( e.id );
                OPTION.text( e.text );
                $("[label='activos']").append( OPTION );
            });
            response.inactives.forEach(function(e){
                var OPTION = $("<option></option>");
                OPTION.val( e.id );
                OPTION.text( e.text );
                $("[label='inactivos']").append( OPTION );
            });
            $("#slp").multipleSelect({
                placeholder : "Vendedores..."
            });
            $("#slp-container").show();
            $("#slp-loader").hide();
            $("#search-slp-button").removeAttr("disabled");
        }
    });
}