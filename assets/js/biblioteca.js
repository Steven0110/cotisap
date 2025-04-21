

/**
*
* @author GerardoSteven (Steven0110)
*/


var lang_ES_EN = {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
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
}

$(document).ready(function(){
	loadDocuments();
});
function loadDocuments(){
	var sliders, caps;

	$.ajax({	//	SLIDERS
		url : route + "/../slider/all",
		method : "GET",
		contentType : false,
		processData : false,
		cache : false,
		success : function( responseSliders ){
			sliders = responseSliders.data;
			$.ajax({	//	CAPACITACIÓN
				url : route + "/../capacitacion/all",
				method : "GET",
				cache : false,
				contentType : false,
				processData : false,
				success : function( responseCaps ){
					/**
					* Agregar el ajax para las herramientas
					**/
					caps = responseCaps.data;
					displayDocs( sliders, caps );
				}
			})
		}
	});
}
function displayDocs( sliders, caps ){

	var TBODY = $("#docs-table tbody");
	var TABLE = $("#docs-table");
		//	SLIDERS 
	for( var i = 0 ; i < sliders.length ; i++ ){
		var TR = $("<tr></tr>");
		var TD_TIPO = $("<td class='text-center'>Slider</td>");
		var TD_TITULO = $("<td class='text-center'><p>"+ sliders[ i ].titulo + "</p></td>");
		var TD_CAT = $("<td class='text-center'>N/A</td>");
		var aux_archivo = sliders[ i ].archivo.split("/");
		aux_archivo = "/storage/" + aux_archivo[ 1 ];
		var TD_ARCHIVO = $("<td class='text-center'><a href='" + aux_archivo + "'><img height='50px' class='img-round' src='" + aux_archivo + "' /></a></td>");
		var TD_LINK = $("<td class='text-center'>N/A</td>");
		var TD_STATUS = $("<td class='text-center'></td>");
			var TAG_status = $("<span class='msg-tag' id='status-"+sliders[ i ].id+"'></span>");
			TAG_status.addClass( sliders[ i ].status == "1" ? "read" : "spam" );
			TAG_status.text( sliders[ i ].status == "1" ? "ACTIVO" : "INACTIVO" );
			TD_STATUS.append( TAG_status );
		TR.append(TD_TIPO);
		TR.append(TD_TITULO);
		TR.append(TD_CAT);
		TR.append(TD_ARCHIVO);
		TR.append(TD_LINK);
		TR.append(TD_STATUS);
		TBODY.append(TR);
	}
		//	caps 
	for( var i = 0 ; i < caps.length ; i++ ){
		var TR = $("<tr></tr>");
		var TD_TIPO = $("<td class='text-center'>Capacitación</td>");
		var TD_TITULO = $("<td class='text-center'><p>"+ caps[ i ].titulo + "</p></td>");
		var TD_CAT = $("<td class='text-center'>" + caps[ i ].categoria + "</td>");
		var aux_archivo = caps[ i ].archivo.split("/");
		aux_archivo = "/storage/" + aux_archivo[ 1 ];
		var TD_ARCHIVO = $("<td class='text-center'><a href='" + (caps[ i ].archivo == "" ? "#" : aux_archivo ) + 
			"'>" + (caps[ i ].archivo == "" ? "N/A" : "Ver" ) + "</a></td>");
		var TD_LINK = $("<td class='text-center'>" + (caps[ i ].link == "" ? "N/A" : caps[ i ].link ) + "</td>");
		var TD_STATUS = $("<td class='text-center'></td>");
			var TAG_status = $("<span class='msg-tag' id='status-"+caps[ i ].id+"'></span>");
			TAG_status.addClass( caps[ i ].status == "1" ? "read" : "spam" );
			TAG_status.text( caps[ i ].status == "1" ? "ACTIVO" : "INACTIVO" );
			TD_STATUS.append( TAG_status );
		TR.append(TD_TIPO);
		TR.append(TD_TITULO);
		TR.append(TD_CAT);
		TR.append(TD_ARCHIVO);
		TR.append(TD_LINK);
		TR.append(TD_STATUS);
		TBODY.append(TR);
	}
	TABLE.DataTable( {
		language : lang_ES_EN
	});
	TABLE.show();
}