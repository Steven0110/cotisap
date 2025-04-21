
var lang_ES_EN = {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "No hay información de éste socio de negocios",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
};

$(document).ready(function(){
    $("#search-button").on("click", updateDeliver );
    $("#search-slp-button").on("click", generateReport );
    $("#return-button").on("click", function(){window.history.go(-1)});

    loadSelectListener();
    loadComponents();
    loadSLP();
});

function loadComponents(){
    $("#deliver-table").DataTable({
        language : lang_ES_EN,
        "columnDefs": [
            {"className": "dt-center", "targets": "_all"}
        ],
        columns: [
            { title: "Artículo." },
            { title: "Cantidad" },
            { title: "Importe" }
        ],
        "autoWidth": false
    });
    //$("#deliver-table_wrapper").hide();

    var url = new URL( window.location.href );
    var id =  url.searchParams.get("id");
    if( id != null ){
        console.log( id );
        $("#num").append( $("<option value='" + id + "'>" + id + "</option>"));
        $("#num").val( id ).trigger("change.select2");
        $("#search-button").click();
    }
}

function loadSelectListener(){
    $("#num").select2({
        ajax: {
            url: route + "/getAllDelivers",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },
        placeholder: 'Introduzca el número de entrega ...',
        minimumInputLength: 3,
        language: 'es'
    });
    $("#num").on("select2:select", updateDeliver );
}

function updateDeliver( event ){
    var docNum = event.params === undefined ? $("#select2-num-container").text() : event.params.data.id;

    $("#deliver-table-loader").show();
    $("#deliver-table_wrapper").hide();
    $("#dlv-num").text( docNum );
    $.ajax({
        method : "GET",
        url : route + "/getDeliver",
        data : {
            "docNum" : docNum
        },
        success : function( response ){
            console.log( response );
            var deliver = response;
            var TABLE = $("#deliver-table").DataTable();
            TABLE.clear();

            if( deliver.doc !== false ){
                $("#client").val( "[" + deliver.doc.CardCode + "] - " + deliver.doc.CardName );
                $("#doc-date").val( deliver.doc.DocDate );
                $("#deliver").val( deliver.doc.DocDueDate );
                $("#folio").val( deliver.doc.NumAtCard === null ? "N/A" : deliver.doc.NumAtCard );

                var icon = $("#status").siblings(".an-input-group-addon").find("i");
                if( deliver.doc.DocStatus === "Cerrado"){
                    icon.addClass("ion-locked");
                    icon.removeClass("ion-unlocked");
                }else{
                    icon.addClass("ion-unlocked");                    
                    icon.removeClass("ion-locked");
                }
                $("#status").val( deliver.doc.DocStatus );

                $("#com").val( deliver.doc.Comments );

                for( var i = 0 ; i < deliver.articles.length ; i++ ){
                    var aux = new Array();
                    aux.push( deliver.articles[ i ].ItemCode + " - " + deliver.articles[ i ].Dscription );
                    aux.push( sliceNumber(deliver.articles[ i ].Quantity, 2) );
                    aux.push( formatCurrency(sliceNumber(deliver.articles[ i ].LineTotal, 2)) );
                    TABLE.row.add( aux );
                }
                TABLE.draw();

                var total = Number(sliceNumber( deliver.doc.DocTotal, 2));
                var subtotal = total / 1.16;
                var iva = subtotal * 0.16;


                $("#total").text( formatCurrency(sliceNumber( deliver.doc.DocTotal, 2)) );
                $("#iva").text( formatCurrency(sliceNumber(iva, 2)) );
                $("#sub").text( formatCurrency(sliceNumber(subtotal, 2)) );


                //$("#deliver-table").show();
                $("#deliver-table-loader").hide();
                $("#deliver-table_wrapper").show();
            }
        }
    });
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
function generateReport(){
    $("#report-loader").show();
    var slp_array = $("#slp").val();
    var data = new Array();
    slp_array.forEach(function(e){
        data.push({ "name" : "slp_code", "value" : e});
    });
    var url = location.href + "/getReport?" + $.param({ slp_codes : slp_array });
    window.open( url, "_blank");
}