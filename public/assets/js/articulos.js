

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
	$('[data-toggle="tooltip"]').tooltip({trigger: "manual"});
	$(".not-null").on("keyup", checkEmptyness );
	$(".upper-case").on("keyup", upperCaseSet );
	$("#action-btn").click( updateArticle );
	loadArticles();
});
function loadArticles(){
	$.ajax({
		method : "GET",
		url : route + "/all",
		cache: false,
		processData: false,
		contentType: false,
		success : function( response ){
			var articles =  response.data;
			showArticles( articles );
			$("#data-loader").remove();
		}
	});
}
function showArticles( articles ){

	var TBODY = $("#articles-table tbody");
	var TABLE = $("#articles-table");
	for( var i = 0 ; i < articles.length ; i++ ){
		var TR = $("<tr></tr>");
		var TD_ID = $("<td id='id-" + articles[ i ].id + "' class='text-center'>" + articles[ i ].id + "</td>");
		var TD_CODIGO = $("<td id='codigo-" + articles[ i ].id + "' class='text-center'>" + articles[ i ].codigo + "</td>");
		//var TD_NOMBRE = $("<td id='nombre-" + articles[ i ].id + "' class='text-center'>" + articles[ i ].nombre + "</td>");
		var TD_DESC = $("<td id='desc-" + articles[ i ].id + "' class='text-center'>" + articles[ i ].descripcion + "</td>");
		var TD_CLASE = $("<td id='clase-" + articles[ i ].id + "' class='text-center'>" + articles[ i ].clase + "</td>");
		var TD_GRUPO = $("<td id='grupo-" + articles[ i ].id + "' class='text-center'>" + articles[ i ].grupo + "</td>");
		var TD_LISTA = $("<td id='lista-" + articles[ i ].id + "' class='text-center'>" + articles[ i ].lista + "</td>");
		var TD_PRECIO = $("<td id='precio-" + articles[ i ].id + "' class='text-center'> $" + articles[ i ].precio + "</td>");
		var TD_MONEDA = $("<td id='moneda-" + articles[ i ].id + "' class='text-center'> " + articles[ i ].moneda + "</td>");
		var TD_UMV = $("<td id='umv-" + articles[ i ].id + "' class='text-center'> " + articles[ i ].UMV + "</td>");
		var TD_COM = $("<td id='com-" + articles[ i ].id + "' class='text-center'> " + articles[ i ].comentarios + "</td>");
		var TD_USR = $("<td id='usr-" + articles[ i ].id + "' class='text-center'> " + articles[ i ].user_id + "</td>");
		var TD_STATUS = $("<td class='text-center'></td>");
			var TAG_status = $("<span class='msg-tag' id='status-"+articles[ i ].id+"'></span>");
			TAG_status.addClass( articles[ i ].status == 1 ? "read" : "spam" );
			TAG_status.text( articles[ i ].status == 1 ? "ACTIVO" : "INACTIVO" );
			TD_STATUS.append( TAG_status );
		var TD_EDIT = $("<td></td>");
			var BUTTON_EDIT = $("<button id='edit-"+articles[ i ].id+"' type='button' class='an-btn an-btn-icon small update-btn'><i class='icon-setting'></i></button>");
			TD_EDIT.append( BUTTON_EDIT );
		var TD_DEL = $("<td></td>");
			var BUTTON_DEL  = $("<button id='delete-"+articles[ i ].id+"' class='an-btn an-btn-icon small muted danger delete-btn'><i class='icon-trash'></i></button>");
			TD_DEL.append( BUTTON_DEL );

		var HIDDEN_INFO = $("<div style='display:none;'></div>");
			var P_COM = $("<p id='com-" + articles[ i ].id + "'> " + articles[ i ].comentarios + "</p>");
			var P_CLASE = $("<p id='clase-" + articles[ i ].id + "'> " + articles[ i ].clase + "</p>");
			var P_GRUPO = $("<p id='grupo-" + articles[ i ].id + "'> " + articles[ i ].grupo + "</p>");
			var P_USER = $("<p id='grupo-" + articles[ i ].id + "'> " + articles[ i ].user_id + "</p>");
			HIDDEN_INFO.append( P_COM );
			HIDDEN_INFO.append( P_CLASE );
			HIDDEN_INFO.append( P_GRUPO );
			HIDDEN_INFO.append( P_USER );

		TR.append(TD_ID);
		TR.append(TD_CODIGO);
		//TR.append(TD_NOMBRE);
		TR.append(TD_DESC);
		TR.append(TD_LISTA);
		TR.append(TD_PRECIO);
		TR.append(TD_MONEDA);
		TR.append(TD_UMV);;
		TR.append(TD_STATUS);
		TR.append(TD_EDIT);
		TR.append(TD_DEL);

		TR.append(HIDDEN_INFO);
		TBODY.append(TR);
	}
	TABLE.DataTable({
		language : lang_ES_EN,

		"fnDrawCallback": function( oSettings ) {

			$(".delete-btn").off();
			$(".delete-btn").on("click", deleteArticle );
			$(".update-btn").off();
			$(".update-btn").on("click", openUpdateSection );
    	}
	});
	TABLE.show();
}
function openUpdateSection( elem ){
	elem = $(elem.currentTarget);
	var id_attribute = elem.attr("id");
	var id_attriute_splitted = id_attribute.split("-");
	var id = id_attriute_splitted[ 1 ];

	$("#update-btn-trigger").click();
	$("#id").val( $("#id-" + id).text() );
	$("#codigo").val( $("#codigo-" + id).text() );
	//$("#nombre").val( $("#nombre-" + id).text() );
	$("#desc").val( $("#desc-" + id).text() );
	$("#com").val( $("#com-" + id).text() );
	$("#lista").val( $("#lista-" + id).text() );
	$("#precio").val( Number( $("#precio-" + id).text().replace("$", "")).toFixed(2) );
	$("#moneda").val( $("#moneda-" + id).text() );
	$("#umv").val( $("#umv-" + id).text() );
	$("#status-" + id).text() == "ACTIVO" ? $("#activo").prop("checked", true) : $("#inactivo").prop("checked", true);


}
function deleteArticle( elem ){
	elem = $(elem.currentTarget);
	var id_attribute = elem.attr("id");
	var id_attriute_splitted = id_attribute.split("-");
	var id = id_attriute_splitted[ 1 ];
	$.ajax({
		url : route + "/" + id,
		method : "DELETE",
		contentType : false,
		processData : false,
		cache : false,
		success : function( response ){
			console.log( response );
			//location.reload();
		}

	});
}
function updateArticle(){
	id = $("#id").val();
	var data = new FormData();
  	data.append('descripcion', $("#desc").val());
  	data.append('comentarios', $("#com").val());
  	//data.append('nombre', $("#nombre").val());
  	data.append('lista', $("#lista").val());
  	data.append('precio', $("#precio").val());
  	data.append('moneda', $("#moneda").val());
  	data.append('umv', $("#umv").val());
  	data.append('status', $("#activo").is(":checked"));
  	data.append('_method', "PUT");
	if( checkEmptynessAll() ){
		$("#action-btn span").text("");
		$("#action-btn img").show();
		$.ajax({
			method : "POST",
			url: route + "/" + id,
			data : data,
			contentType : false,
			processData : false,
			cache : false,
			success : function(response){
				console.log( response );
				location.reload();
			}
		});
	}else{
		return false;
	}
}
function switchInputStatus( input, status, message ){
	if( status === true ){
		input.removeClass("danger");
		input.addClass("ok");
		input.tooltip("hide");
	}else{
		input.attr("data-original-title", message);
		input.attr("title", message);
		input.removeClass("ok");
		input.addClass("danger");
		input.tooltip("show");
	}
}