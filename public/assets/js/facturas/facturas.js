
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
	$("#search-button").on("click", updateInvoice );
	loadSelectListener();
	loadComponents();
});
function loadComponents(){
	$("#invoice-table").DataTable({
		language : lang_ES_EN,
		"columnDefs": [
        	{"className": "dt-center", "targets": "_all"}
      	],
		columns: [
            { title: "Artículo." },
            { title: "Cantidad" },
            { title: "Importe" },
            { title: "Sigla 03" }
        ],
        "autoWidth": false
	});
	$("#invoice-table_wrapper").hide();

	var url = new URL( window.location.href );
	var id =  url.searchParams.get("id");
	if( id != null ){
		console.log( id );
		$("#numPedido").append( $("<option value='" + id + "'>" + id + "</option>"));
		$("#numPedido").val( id ).trigger("change.select2");
		$("#search-button").click();
	}
}
function loadSelectListener(){
	$("#numPedido").select2({
		ajax: {
			url: route + "/getAllInvoices",
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
		placeholder: 'Introduzca el número de factura ...',
		minimumInputLength: 3,
		language: 'es'
    });
    $("#numPedido").on("select2:select", updateInvoice );
}
function updateInvoice( event ){
	var docNum = event.params === undefined ? $("#select2-numPedido-container").text() : event.params.data.id;

	$("#invoice-table-loader").show();
	$("#invoice-table_wrapper").hide();
	$.ajax({
		method : "GET",
		url : route + "/getInvoice",
		data : {
			"docNum" : docNum
		},
		success : function( response ){

			$("#invoice-table_wrapper").show();
			var TABLE = $("#invoice-table").DataTable();
			TABLE.clear();

			var _document = response.document;
			var _articles = response.articles;
			$("#fact-num").text(_document["DocNum"]);
			$("#folio").val(_document["NumAtCard"]);
			//$("#doc-num").val(_document["EDocNum"]);
			$("#doc-date").val(_document["DocDate"].toString().substring(0, 10));
			$("#expiration").val(_document["DocDueDate"].toString().substring(0, 10));
			
			for( var i = 0 ; i < _articles.length ; i++ ){
				var aux = new Array();
				aux.push( (_articles[ i ].ItemCode === null ? "[---]" : "[" + _articles[ i ].ItemCode + "]") 
					+ " - "
					+ _articles[ i ].Dscription );
				aux.push( sliceNumber(_articles[ i ].Quantity, 2) );
				aux.push( formatCurrency(sliceNumber(_articles[ i ].LineTotal, 2)) );
				aux.push( _articles[ i ].U_Sigla03 == null ? "N/A" : _articles[ i ].U_Sigla03 );
				TABLE.row.add( aux );
			}
			TABLE.draw();
			var total = Number(sliceNumber(_document["DocTotal"], 2));
			var subtotal = total / 1.16;
			var iva = subtotal * 0.16;
			$("#iva").text( formatCurrency(sliceNumber(iva, 2)) );
			$("#sub").text( formatCurrency(sliceNumber(subtotal, 2)) );
			$("#total").text( formatCurrency(sliceNumber(_document["DocTotal"], 2)) );
			$("#com").val(_document["Comments"]);

			$("#invoice-table").show();
			$("#invoice-table-loader").hide();

			setDownloadURL( 
				id_cmp,
				_document
			);
		}
	});
}
function setDownloadURL( id, _document ){

	var year = Number( _document["DocDate"].toString().substring(0, 4 ) );
	var url_base, eDoc;
	if( year < 2018 ){
		eDoc = _document["EDocNum"];
		$("#doc-num").val( eDoc );
		var base_url = "http://corporativo-vallejo-tntchvdtpq.dynamic-m.com:8082/" + 
			id + "/" + _document["DocDate"].toString().substring( 0, 7 ) + 
			"/" + _document["CardCode"] + "/IN/" + eDoc;
		$("#pdf-button").off();
		$("#pdf-button").on("click", function(){window.open(base_url + ".pdf")});
		$("#xml-button").off();
		$("#xml-button").on("click", function(){window.open(base_url + ".xml")});
	}else{
		var carry_url = "http://corporativo-vallejo-tntchvdtpq.dynamic-m.com:8082/" + 
			id + "/" + _document["DocDate"].toString().substring( 0, 7 ) + 
			"/" + _document["CardCode"] + "/IN/";
		setNewEDoc( carry_url, _document["DocNum"] );
	}
}

function setNewEDoc(carry_url, num ){
	$.ajax({
		url : route + "/getNewEDoc",
		data : { "num" : num },
		success : function( response ){
			$("#pdf-button").off();
			$("#pdf-button").on("click", function(){window.open(carry_url + response[ 0 ]["ReportID"] + ".pdf")});
			$("#xml-button").off();
			$("#xml-button").on("click", function(){window.open(carry_url + response[ 0 ]["ReportID"] + ".xml")});
		}
	});
}