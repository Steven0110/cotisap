

/**
*
* @author GerardoSteven (Steven0110)
*/


var sliders;
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

var LIMIT_BY_PAGE = 6;
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip({trigger: "manual"});
	$("#create-btn").click( setCreateComponent );
	$("#div-add").show();
	getAllSliders();
});

function setCreateComponent(){
	clearForm();
	$("#create-instr").show();
	$("#update-instr").hide();
	$("#row-id").hide();
	$("#row-status").hide();
	$("#action-btn span").text( "Guardar" );
	$("#upload_img span").text("Subir imagen");
	$("#row-file").show();
	addCreateListeners();
}
function setUpdateComponent(elem){
	elem = elem.currentTarget;
	var full_id = $(elem).attr("id");
	var aux = full_id.split("-");
	var id = aux[1];

	$("#row-id").show();
	$("#update-instr").show();
	$("#create-instr").hide();
	$("#update-btn-trigger").click();
	$("#row-status").show();
	$("#row-file").hide();
	$("#action-btn").click( {id: id}, updateSlider );
	$("#action-btn span").text( "Actualizar" );

	loadSliderInfo( id );
	addUpdateListeners();
}
function addCreateListeners(){
	$("#action-btn").click( storeSlider );
	$("#upload_img").click( uploadEvent );
	$("#input_img").on("change", setImageToUpload );
	$("#titSlider").on("keyup", checkTitleInput );
}
function addUpdateListeners(){
	$("#titSlider").on("keyup", checkTitleInput );
}
function loadSliderInfo( id ){
	$("#idSlider").val( id );
	$("#titSlider").val($("#title-" + id).text());
	$("#check-int-" + id).prop("checked") ? $("#check-int").prop("checked", true) : $("#check-int").prop("checked", false);
	$("#check-ext-" + id).prop("checked") ? $("#check-ext").prop("checked", true) : $("#check-ext").prop("checked", false);
	$("#status-" + id).text() == "ACTIVO" ? $("#activo").prop("checked", true) : $("#inactivo").prop("checked", true)
}
function storeSlider(){
	var data = new FormData();
  	data.append('archivo', $('#input_img')[0].files[0]);
  	data.append('titulo', $("#titSlider").val());
  	data.append('esInterno', $("#check-int").is(":checked"));
  	data.append('esExterno', $("#check-ext").is(":checked"));
	if( validateForm() ){
		$("#action-btn span").text("");
		$("#action-btn img").show();
		$.post({
			//url: "./",
			url: route,
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
function searchSlider(event){
	var searchText = $("#search").val();
	var searchStatus = $("#select-status option:selected").val();
	if( searchText.length == 0 && searchStatus == "unchosen" )
		$(".list-user-single").show();
	else{
		console.log( searchStatus );
		for( var i = 0 ; i < sliders.length ; i++ ){
			$("#row-" + sliders[ i ].id ).hide();
			if( searchStatus !== "unchosen" ){	
				if( sliders[ i ].titulo.indexOf( searchText ) !== -1 && sliders[ i ].status === searchStatus ){
					$("#row-" + sliders[ i ].id ).show();
				}
			}else{
				if( sliders[ i ].titulo.indexOf( searchText ) !== -1){
					$("#row-" + sliders[ i ].id ).show();
				}
			}
		}
	}
}
function validateForm(){
	if( checkTitleInput() & checkFileInput() ){
		return true;
	}else{
		return false;
	}
}
function uploadEvent(){
	$("#input_img").click();
}
function clearForm(){
	$("#titSlider").val("");
}
function setImageToUpload(){
	var filename = $("#input_img").val();
	var splited_path = filename.split("\\");
	filename = splited_path[splited_path.length - 1 ];
	if( validateImageInput( filename ) ){
		$("#upload_img span").text( filename );
	}else{
		$("#upload_img span").text("Subir imagen...");
	}
	checkFileInput();
}
function validateImageInput( filename ){
	var types = ["jpg", "jpeg", "png", "gif"];
	var extension = filename.split(".");
	extension = extension[ extension.length - 1 ];
	if( !isInArray( extension, types ) ){
		swal("Archivo incorrecto", "Sólo se permite subir imágenes en ésta sección", "warning");
		return false;
	}else return true;
}
function checkTitleInput(){
	var titSliderInput = $("#titSlider");
	var titSliderIcon = $("#titSliderIcon i");
	var val = titSliderInput.val();
	if( isEmpty( val ) ){
		switchInputStatus( titSliderInput, titSliderInput, "wrong", "El campo está vacío");
		return false;
	}else{
		switchInputStatus( titSliderInput, titSliderInput, "ok", "");
		return true;
	}	
}
function checkFileInput(){
	var file_input = $("#input_img");
	var upload_button = $("#upload_img");
	var upload_button_icon = $("#upload_img i");
	var val = file_input.val();
	if( isEmpty( val ) ){
		upload_button_icon.tooltip("show");
		return false;
	}else{
		upload_button_icon.tooltip("hide");
		return true;
	}
}
function switchInputStatus( input, icon, type, message){
	if( type === "ok"){
		icon.removeClass("ion-close")
		icon.addClass("ion-ios-checkmark-outline")
		input.attr("data-original-title", message);
		input.attr("title", message);
		input.removeClass("danger");
		input.addClass("ok");
		input.tooltip("hide");
	}else{
		icon.removeClass("ion-ios-checkmark-outline")
		icon.addClass("ion-close")
		input.attr("data-original-title", message);
		input.attr("title", message);
		input.removeClass("ok");
		input.addClass("danger");
		input.tooltip("show");

	}
}
function getAllSliders(){
	var page = getUrlParameter("page");
	$.get({
		url : route + "/all",
		//url : utf8_encode( route + "/all" ),
		//url : "slider/all",
		//url : "all",
		processData : false,
		cache : false,
		success : function( response ){
			var data = response.data;
			sliders = data;
			$("#search").on("keyup", searchSlider );
			$("#select-status").on("change", searchSlider );
			//showSliders( data, page );
			showSliders( data );
			$("#data-loader").remove();
			$(".delete-btn").on("click", deleteSlider );
			$(".update-btn").on("click", setUpdateComponent );
		}
	});
}
function showSliders( data ){
	var TBODY = $("#slider-table tbody");
	var TABLE = $("#slider-table");
	for( var i = 0 ; i < data.length ; i++ ){
		var TR = $("<tr></tr>");
		var TD_ID = $("<td class='text-center'>" + data[ i ].id + "</td>");
		var TD_TITULO = $("<td class='text-center'><p id='title-" + data[ i ].id + "'>" + data[ i ].titulo + "</p></td>");
		var aux_archivo = data[ i ].archivo.split("/");
		aux_archivo = "/storage/" + aux_archivo[ 1 ];
		//var TD_ARCHIVO = $("<td class='text-center'><a href='" + aux_archivo + "'><h2><i class='ion-image'></i></h2></a></td>");
		var TD_ARCHIVO = $("<td class='text-center'><a href='" + aux_archivo + "'><img height='50px' class='img-round' src='" + aux_archivo + "' /></a></td>");
		var TD_INTERNO = $("<td class='text-center'></td>");
			var SPAN_INT = $("<span class='an-custom-checkbox'></span>");
			var LABEL_INT = $("<label for='check-int-" + data[ i ].id + "'></label>");
			var CHECK_interno = $("<input type='checkbox' id='check-int-"+data[ i ].id+"' disabled='disabled'/>");
			data[ i ].interno == 1 ? CHECK_interno.attr("checked", "checked") : CHECK_interno.removeAttr("checked");
			SPAN_INT.append(CHECK_interno);
			SPAN_INT.append(LABEL_INT);
			TD_INTERNO.append( SPAN_INT );
		var TD_EXTERNO = $("<td class='text-center'></td>");
			var SPAN_EXT = $("<span class='an-custom-checkbox'></span>");
			var LABEL_EXT = $("<label for='check-int-" + data[ i ].id + "'></label>");
			var CHECK_externo = $("<input type='checkbox' id='check-ext-"+data[ i ].id+"' disabled='disabled'/>");
			data[ i ].cliente == 1 ? CHECK_externo.attr("checked", "checked") : CHECK_externo.removeAttr("checked");
			SPAN_EXT.append(CHECK_externo);
			SPAN_EXT.append(LABEL_EXT);
			TD_EXTERNO.append( SPAN_EXT );
		var TD_STATUS = $("<td class='text-center'></td>");
			var TAG_status = $("<span class='msg-tag' id='status-"+data[ i ].id+"'></span>");
			TAG_status.addClass( data[ i ].status == "1" ? "read" : "spam" );
			TAG_status.text( data[ i ].status == "1" ? "ACTIVO" : "INACTIVO" );
			TD_STATUS.append( TAG_status );
		var TD_EDIT = $("<td></td>");
			var BUTTON_EDIT = $("<button id='edit-"+data[ i ].id+"' type='button' class='an-btn an-btn-icon small update-btn'><i class='icon-setting'></i></button>");
			TD_EDIT.append( BUTTON_EDIT );
		var TD_DEL = $("<td></td>");
			var BUTTON_DEL  = $("<button id='delete-"+data[ i ].id+"' class='an-btn an-btn-icon small muted danger delete-btn'><i class='icon-trash'></i></button>");
			TD_DEL.append( BUTTON_DEL );
		TR.append(TD_ID);
		TR.append(TD_TITULO);
		TR.append(TD_ARCHIVO);
		TR.append(TD_INTERNO);
		TR.append(TD_EXTERNO);
		TR.append(TD_STATUS);
		TR.append(TD_EDIT);
		TR.append(TD_DEL);
		TBODY.append(TR);
	}
	TABLE.DataTable( {
		language : lang_ES_EN
	});
	$("#slider-table").show();
}
/*
function showSliders( data, page_no ){

	var page = page_no ? page_no : 1;
	var begin = (page - 1) * (LIMIT_BY_PAGE - 1);
	var end = (page - 1) * (LIMIT_BY_PAGE - 1) + (LIMIT_BY_PAGE - 2);
	end = (end + 1) > data.length ? data.length - 1 : end;
	if( page_no === "all" ){
		begin = 0;
		end = data.length - 1;
	}
	var pages = Math.ceil( data.length / ( LIMIT_BY_PAGE - 1 ) );
	$("#resNo").text( ( end - begin + 1 ) );
	$("#resTotal").text( data.length );
	setPagination( page, pages );

	var DIV_table_body = $(".an-lists-body")[0];
	for( var i = begin ; i <= end ; i++ ){

		var splited_path = data[ i ].archivo.split("/");
		var filename = splited_path[splited_path.length - 1 ];
		var short_filename = shortifyFileName( filename );

		var DIV_table_row = $("<div class='list-user-single' id='row-"+data[ i ].id +"'></div>");
		var ROW_id = $("<div class='list-name basis-20'>" +
		                    "<span class='an-custom-checkbox'>" +
		                      "<input type='checkbox' id='check-20'>" +
		                      "<label for='check-20'></label>" +
		                    "</span>" +
		                    "<a href='#'>" + data[ i ].id + "</a>" +
		                  "</div>");
		var ROW_title = $("<div class='list-text basis-30'><p id='title-"+data[ i ].id+"'>" + data[ i ].titulo + "</p></div>");
		var ROW_archivo = $("<div class='list-text basis-50'><a href='"+filename+"'>" + short_filename + "</a></div>");
		var ROW_interno = $("<div class='list-name basis-20'></div>");
			var SPAN_ROW_interno = $("<span class='an-custom-checkbox blocked'></span>");
			var LABEL_ROW_interno = $("<label for='check-int-"+data[ i ].id+"'></label>");
			var INPUTCHECK_interno = $("<input type='checkbox' id='check-int-"+data[ i ].id+"' disabled='disabled'/>");
			data[ i ].interno == 1 ? INPUTCHECK_interno.attr("checked" , "checked") : INPUTCHECK_interno.removeAttr("checked");
			SPAN_ROW_interno.append( INPUTCHECK_interno );
			SPAN_ROW_interno.append( LABEL_ROW_interno );
			ROW_interno.append( SPAN_ROW_interno );
		var ROW_externo = $("<div class='list-name basis-20'></div>");
			var SPAN_ROW_externo = $("<span class='an-custom-checkbox blocked'></span>");
			var LABEL_ROW_externo = $("<label for='check-ext-"+data[ i ].id+"'></label>");
			var INPUTCHECK_externo = $("<input type='checkbox' id='check-ext-"+data[ i ].id+"' disabled='disabled'/>");
			data[ i ].cliente == 1 ? INPUTCHECK_externo.attr("checked" , "checked") : INPUTCHECK_externo.removeAttr("checked");
			SPAN_ROW_externo.append( INPUTCHECK_externo );
			SPAN_ROW_externo.append( LABEL_ROW_externo );
			ROW_externo.append( SPAN_ROW_externo );
		var ROW_status = $("<div class='list-state basis-20'></div");
			var TAG_status = $("<span class='msg-tag' id='status-"+data[ i ].id+"'></span>");
			TAG_status.addClass( data[ i ].status == "1" ? "read" : "spam" );
			TAG_status.text( data[ i ].status == "1" ? "ACTIVO" : "INACTIVO" );
			ROW_status.append(TAG_status);
		var ROW_tools = $("<div class='list-action basis-20'>" +
		                    "<div class='btn-group'>" +
		                      "<button id='edit-"+data[ i ].id+"' type='button' class='an-btn an-btn-icon small update-btn'>" +
		                        "<i class='icon-setting'></i>" +
		                      "</button>" +
		                    "</div>" +
		                    "<button id='delete-"+data[ i ].id+"' class='an-btn an-btn-icon small muted danger delete-btn'><i class='icon-trash'></i></button>" +
		                  "</div>");
		DIV_table_row.append(ROW_id);
		DIV_table_row.append(ROW_title);
		DIV_table_row.append(ROW_archivo);
		DIV_table_row.append(ROW_interno);
		DIV_table_row.append(ROW_externo);
		DIV_table_row.append(ROW_status);
		DIV_table_row.append(ROW_tools);
		$(DIV_table_body).append(DIV_table_row[0]);
	}

}
*/

/*
function setPagination( current_page, total_pages ){
	if( current_page === "all"){

	}else{
		var prev_page = Number(current_page) - 1;
		var next_page = Number(current_page) + 1;
		console.log("TOTAL:" + total_pages);
		console.log("CURR:" + current_page);
		console.log("PRV:" + prev_page);
		console.log("NXT:" + next_page);
		var UL_PAGES = $("#pagination");
		var LI_PREV = $("<li id='prev-page'>" +
		                  "<a href='" + route + "?page=" + prev_page + "' aria-label='Previous'>" +
		                    "<span aria-hidden='true'><i class='ion-chevron-left'></i></span>" +
		                  "</a>" +
		                "</li>");
		var LI_NEXT = $("<li id='next-page'>" +
		                  "<a href='" + route + "?page=" + next_page + "' aria-label='Next'>" +
		                    "<span aria-hidden='true'><i class='ion-chevron-right'></i></span>" +
		                  "</a>" +
		                "</li>");
		var LI_PAGES = new Array();
		prev_page >= 1 ? UL_PAGES.append( LI_PREV ) : false;
		for( var i = 1 ; i <= total_pages ; i++ ){
			if( i == current_page )
				var LI_PAGE = "<li><a href='#' class='active'>" + i + "</a></li>";
			else
				var LI_PAGE = "<li><a href='"+ route + "?page=" + i + "'>" + i + "</a></li>";
			UL_PAGES.append( LI_PAGE );		
		}
		next_page <= total_pages ? UL_PAGES.append( LI_NEXT ) : false;
	}
}
*/
function deleteSlider( elem ){
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
			location.reload();
		}

	});
}
function updateSlider( event ){
	id = event.data.id;
	console.log( id );
	var data = new FormData();
  	data.append('titulo', $("#titSlider").val());
  	data.append('esInterno', $("#check-int").is(":checked"));
  	data.append('esExterno', $("#check-ext").is(":checked"));
  	data.append('status', $("#activo").is(":checked"));
  	data.append('_method', "PUT");
	if( checkTitleInput() ){
		$("#action-btn span").text("");
		$("#action-btn img").show();
		$.ajax({
			//url: "./",
			method : "POST",
			url: route + "/" + id,
			data : data,
			contentType : false,
			processData : false,
			cache : false,
			success : function(response){
				location.reload();
			}
		});
	}else{
		return false;
	}
}


function isInArray( string, array ){
	for( var i = 0 ; i < array.length ; i++ )
		if( string === array[ i ] )
			return true;
	return false;
}
function shortifyFileName(filename){
	if( filename.length > 30 ){
		var aux = filename.split(".");
		var modified_name = aux[ 0 ].substring( aux[ 0 ].length - 20, aux[ 0 ].length);
		var new_name = "..." + modified_name + "." + aux[ 1 ];
		return new_name;
	}else return filename;
}

function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
    return false;
}