

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
var categories = {
	"unchosen" : "Sin seleccionar",
	"0" : "Catálogos",
	"1" : "Certificaciones",
	"2" : "Fichas Técnicas",
	"3" : "Manuales",
	"4" : "Varios",
	"5" : "Comunicados",
	"6" : "Video",
	"7" : "Audio"};

$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip({trigger: "manual"});
	$("#create-btn").click( setCreateComponent );	
	$("#create-btn").show();
	getAllCaps();
});

function setCreateComponent(){
	clearForm();
	$("#create-instr").show();
	$("#row-id").hide();
	$("#update-instr").hide();
	$("#row-status").hide();
	$("#row-file").show();
	$("#myModalLabel").show();
	$("#myModalLabel2").hide();
	$("#row-cat-info").hide();
	$("#row-cat").show();
	$("#row-file-choose").show();
	$("#upload_img span").text("Subir imagen");
	$("#action-btn span").text( "Guardar" );
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
	$("#row-status").show();
	$("#myModalLabel").hide();
	$("#myModalLabel2").show();
	$("#row-cat-info").show();
	$("#row-cat").hide();
	$("#row-file").hide();
	$("#row-file-choose").hide();
	$("#action-btn").click( {id: id}, updateCap );
	$("#action-btn span").text( "Actualizar" );

	loadCapInfo( id );
	$("#update-btn-trigger").click();
	addUpdateListeners();
}
function addCreateListeners(){
	$("#action-btn").click( storeCapacitacion );
	$("#upload_file").click( uploadEvent );
	$("#input_file").on("change", setFileToUpload );
	$("#titCap").on("keyup", checkTitleInput );
	$("#descCap").on("keyup", checkDesc );
	$("#linkCap").on("keyup", checkLinkInput )
	$("#link").on("change", checkLink )
	$("#file").on("change", checkFile )
}
function addUpdateListeners(){
	$("#titCap").on("keyup", checkTitleInput );
}
function checkLink(){
	if( $(this).prop("checked") ){
		$("#row-link").show();
		$("#row-file").hide();
	}else{
		$("#row-link").hide();
		$("#row-file").show();
	}
}
function checkFile(){
	if( $(this).prop("checked") ){
		$("#row-link").hide();
		$("#row-file").show();
	}else{
		$("#row-link").show();
		$("#row-file").hide();
	}	
}
function loadCapInfo( id ){
	$("#idCap").val( id );
	$("#titCap").val($("#title-" + id).text());
	$("#descCap").val($("#desc-" + id).text());
	$("#catCap").val($("#cat-" + id).text());
	$("#status-" + id).text() == "ACTIVO" ? $("#activo").prop("checked", true) : $("#inactivo").prop("checked", true)

}
function storeCapacitacion(){
	var data = new FormData();
	if( $("#link").prop("checked") ){
  		data.append('link', $('#linkCap').val() );
  		data.append('archivo', "");
	}
	else{
  		data.append('link', "");
  		data.append('archivo', $('#input_file')[0].files[0]);
	}
  	data.append('titulo', $("#titCap").val());
  	data.append('descripcion', $("#descCap").val());
  	data.append('categoria', $("#select-cat option:selected").text());
	if( validateForm() ){
		$("#action-btn span").text("");
		$("#action-btn img").show();
		$.ajax({
			method : "POST",
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
		console.log("VAL NOT OK");
		return false;
	}
}
function validateForm(){
	if( $("#link").prop("checked")){
		if( checkTitleInput() & checkLinkInput() ){
			return true;
		}else{
			return false;
		}
	}else{
		if( checkTitleInput() & checkFileInput() ){
			return true;
		}else{
			return false;
		}
		
	}
}
function uploadEvent(){
	$("#input_file").click();
}
function clearForm(){
	$("#titCap").val("");
}
function setFileToUpload(){
	var filename = $("#input_file").val();
	var splited_path = filename.split("\\");
	filename = splited_path[splited_path.length - 1 ];
	if( validateFileInput( filename ) ){
		$("#upload_file span").text( filename );
	}else{
		$("#upload_file span").text("Subir imagen...");
	}
	checkFileInput();
}
function validateFileInput( filename ){
	var types = ["pdf", "doc", "docx", "xls", "xlsx", "jpg", "png", "txt"];
	var extension = filename.split(".");
	extension = extension[ extension.length - 1 ];
	if( !isInArray( extension, types ) ){
		swal("Archivo incorrecto", "Sólo se permite subir archivos de tipo " +  types.toString() + " en ésta sección", "warning");
		return false;
	}else return true;
}
function checkTitleInput(){
	var titCapInput = $("#titCap");
	var titCapIcon = $("#titCapIcon i");
	var val = titCapInput.val();
	if( isEmpty( val ) ){
		switchInputStatus( titCapInput, titCapIcon, "wrong", "El campo está vacío");
		console.log("title not ok");
		return false;
	}else{
		switchInputStatus( titCapInput, titCapIcon, "ok", "");
		return true;
	}	
}
function checkSelect(){
	var select = $("#select-cat");
	if( $("#select-cat option:selected").val() == "unchosen" ){
		select.attr("data-original-title", "Selecciona una categoría");
		select.attr("title", "Selecciona una categoría");
		select.tooltip("show");
		return false;
	}else{
		select.attr("data-original-title", "");
		select.attr("title", "");
		select.tooltip("hide");
		return true;
	}
}
function checkLinkInput(){
	var linkCapInput = $("#linkCap");
	var linkCapIcon = $("#linkCapIcon i");
	var val = linkCapInput.val();
	if( isEmpty( val ) ){

		console.log("link not ok");
		switchInputStatus( linkCapInput, linkCapIcon, "wrong", "El campo está vacío");
		return false;
	}else{
		switchInputStatus( linkCapInput, linkCapIcon, "ok", "");
		return true;
	}	
}
function checkDesc(){
	var desc = $("#descCap");
	var val = desc.val();
	if( val == "" ){

		console.log("desc not ok");
		desc.attr("data-original-title", "El campo está vacío");
		desc.attr("title", "El campo está vacío");
		desc.tooltip("show");
	}else{
		desc.attr("data-original-title", "");
		desc.attr("title", "");
		desc.tooltip("hide");
	}

}
function checkFileInput(){
	var file_input = $("#input_file");
	var upload_button = $("#upload_file");
	var upload_button_icon = $("#upload_file i");
	var val = file_input.val();
	if( isEmpty( val ) ){

		console.log("file not ok");
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
function getAllCaps(){
	$.get({
		url : route + "/all",
		processData : false,
		cache : false,
		success : function( response ){
			var data = response.data;
			showCaps( data );
			$("#data-loader").remove();
			$(".delete-btn").on("click", deleteCap );
			$(".update-btn").on("click", setUpdateComponent );
		}
	});
}
function showCaps( data ){
	var TBODY = $("#cap-table tbody");
	var TABLE = $("#cap-table");
	for( var i = 0 ; i < data.length ; i++ ){
		var TR = $("<tr></tr>");
		var TD_ID = $("<td>" + data[ i ].id + "</td>");
		var TD_TITULO = $("<td class='text-center'><p id='title-" + data[ i ].id + "'>" + data[ i ].titulo + "</p></td>");
		var aux_archivo = data[ i ].archivo.split("/");
		aux_archivo = "/storage/" + aux_archivo[ 1 ];
		//var TD_ARCHIVO = $("<td class='text-center'><a href='" + aux_archivo + "'><h2><i class='ion-image'></i></h2></a></td>");
		var TD_DESC = $("<td id='desc-" + data[ i ].id + "' class='text-center'>" + data[ i ].descripcion + "</td>");
		var TD_CAT = $("<td id='cat-" + data[ i ].id + "' class='text-center'>" + data[ i ].categoria + "</td>");
		var TD_ARCHIVO = $("<td class='text-center'><a href='" + (data[ i ].archivo == "" ? "#" : aux_archivo ) + "'>" + (data[ i ].archivo == "" ? "N/A" : "Ver" ) + "</a></td>");
		var TD_LINK = $("<td class='text-center'><a href='" + (data[ i ].link == "" ? "#" : data[ i ].link ) + "'>" + (data[ i ].link == "" ? "N/A" : data[ i ].link ) + "</a></td>");
		
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
		TR.append(TD_DESC);
		TR.append(TD_CAT);
		TR.append(TD_ARCHIVO);
		TR.append(TD_LINK);
		TR.append(TD_STATUS);
		TR.append(TD_EDIT);
		TR.append(TD_DEL);
		TBODY.append(TR);
	}
	TABLE.DataTable({
		language : lang_ES_EN
	});
	$("#cap-table").show();
}
function deleteCap( elem ){
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
function updateCap( event ){
	id = event.data.id;
	console.log( id );
	var data = new FormData();
  	data.append('titulo', $("#titCap").val());
  	data.append('descripcion', $("#descCap").val());
  	data.append('categoria', $("#catCap").val());
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
