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
	$("#create-btn").click( setCreateComponent );	
	$("#create-btn").show();
	$(".not-null").on("focusout", checkInputEmptyness );
	getAllSpecs();
	$("#specs-table").DataTable({
		"columnDefs": [
        	{"className": "dt-center", "targets": "_all"},
        	{"render" : function(data, type, row){
				        		return "<span class='id'>" + data + "</span>";
				   		}, "targets" : 0 },
        	{"render" : function(data, type, row){
				        		return "<span class='type' data='" + data + "'>" + getType( data ) + "</span>";
				   		}, "targets" : 1 },
        	{"render" : function(data, type, row){
				        		return "<span class='title'>" + data + "</span>";
				   		}, "targets" : 2 },
        	{"render" : function(data, type, row){
				        		return "<span class='desc'>" + listify(data) + "</span>";
				   		}, "targets" : 3 },
        	{"render" : function(data, type, row){
				        		return "<img data='" + data + "' class='edit' src='" + edit_img_route + "' height='30' width='30'/>";
				   		}, "targets" : 4 },
        	{"render" : function(data, type, row){
				        		return "<img data='" + data + "' class='delete' src='" + delete_img_route + "' height='30' width='30'/>";
				   		}, "targets" : 5 }
      	],
		language: lang_ES_EN,
		columns : [
			{title : "ID"},
			{title : "Tipo"},
			{title : "Nombre"},
			{title : "Descripción"},
			{title : "Editar"},
			{title : "Eliminar"}
		],
		"fnDrawCallback": function( oSettings ) {
			$(".delete").off();
			$(".delete").on("click", deleteSpec );
			$(".edit").off();
			$(".edit").on("click", setUpdateComponent );
    	}
	});
});
function setCreateComponent(){
	clearForm();
	$("#create-instr").show();
	$("#update-instr").hide();
	$("#row-type").hide();
	$("#row-select-type").show();
	$("#row-id").hide();
	$("#add-label").show();
	$("#update-label").hide();
	$("#action-btn span").text( "Guardar" );
	$("#action-btn").off();
	$("#action-btn").on("click", storeSpec );
}
function getAllSpecs(){
	$.get({
		url : route + "/all",
		processData : false,
		cache : false,
		success : function( response ){
			var data = response.data;
			showSpecs( data );
			$("#data-loader").remove();
		}
	});
}
function setUpdateComponent(event){
	clearForm();
	$("#create-instr").hide();
	$("#update-instr").show();
	$("#row-id").show();
	$("#row-type").show();
	$("#row-select-type").hide();
	$("#add-label").hide();
	$("#update-label").show();
	$("#action-btn span").text( "Actualizar" );
	$("#action-btn").off();
	$("#action-btn").on("click", updateSpec );

	var id = $(event.currentTarget).parents("tr").find(".id").text();
	var type = $(event.currentTarget).parents("tr").find(".type").attr("data");
	var title = $(event.currentTarget).parents("tr").find(".title").text();
	var desc = $(event.currentTarget).parents("tr").find(".desc").text();
	$("#id").val( id );
	$("#title").val( title );
	$("#desc").val( unlistify(desc) );

	$("#type-update").val( getType(type) );

	$("#update-btn-trigger").click();
}
function validateForm(){
	var valid_count = 0;
	$(".not-null").each(function(){
		checkInputEmptyness( $(this) ) ? null : valid_count-- ;
	});
	return valid_count >= 0;
}
function showSpecs( data ){
	var TABLE = $("#specs-table").DataTable();
	data.forEach(function(e){
		var array = new Array();
		array.push(e.id);
		array.push(e.tipo);
		array.push(e.nombre);
		array.push(e.descripcion);
		array.push(e.id);
		array.push(e.id);
		TABLE.row.add( array );
	});
	TABLE.draw();
	$("#container").show();
}
function storeSpec(){
	var type_no = $("#type option:selected").val();
	$("#ajax-loader").show();
	if( validateForm() ){
		$.ajax({
			method : "POST",
			url : route,
			data : {
				"title" : $("#title").val(),
				"desc" : $("#desc").val(),
				"type" : type_no
			},
			success : function( response ){
				if( response.status ){
					swal("OK", "Especificación agregada correctamente", "success");
					var TABLE = $("#specs-table").DataTable();
					TABLE.row.add([
						response.id,
						type_no,
						$("#title").val(),
						listify($("#desc").val()),
						$("#id").val(),
						$("#id").val()
					]);
					$("#ajax-loader").hide();
					$("#close").click();
					TABLE.draw();
				}
			}
		});
	}
}
function updateSpec(){
	$("#ajax-loader").show();
	if( validateForm() ){
		$.ajax({
			method : "POST",
			url : route + "/" + $("#id").val(),
			data : {
				"title" : $("#title").val(),
				"desc" : $("#desc").val(),
				"_method" : "PUT"
			},
			success : function( response ){
				if( response.status ){
					$("#ajax-loader").hide();
					swal("OK", "Especificación actualizada correctamente", "success");
					var parents = $("#specs-table span:contains('" + $("#id").val() +  "')").parents("tr");
					parents.find(".title").text($("#title").val());
					parents.find(".desc").html(listify($("#desc").val()));
					$("#close").click();
				}
			}
		});
	}
}
function deleteSpec(event){
	var id = $(event.currentTarget).parents('tr').find(".id").text();
	$(event.currentTarget).attr("src", ajax_loader_route);
	$.ajax({
		method : "DELETE",
		url : route + "/" + id,
		success : function( response ){
			if( response.status ){
				swal("OK", "Especificación eliminada correctamente", "success");
				var row = $("#specs-table").DataTable().row( $(event.currentTarget).parents('tr') ).remove().draw();
			}
		}
	});
}
function clearForm(){
	$("#id").val("");
	$("#title").val("");
	$("#desc").val("");
}
function getType( n ){
	n = Number(n);
	switch( n ){
		case 0:
			return "Condiciones comerciales";
			break;
		case 1:
			return "Consideraciones especiales";
			break;
		case 2:
			return "Factores a considerar";
			break;
		case 3:
			return "Entrega Express";
			break;
		case 4:
			return "Viáticos de consultores";
			break;
		case 5:
			return "Alcance de implementación";
			break;
	}
}
function listify( string ){
	var listified_string = "<p>- ";
	for( var i = 0 ; i < string.length ; i++ ){
		if( string.charAt( i ) == '\n' )
			listified_string += "</p><p>- ";
		else
			listified_string += string.charAt( i );
	}
	listified_string += "</p>";
	return listified_string;
}
function unlistify( string ){
	var final = string.replace(/(?!^)-\s{1,}/g, '\n');
	final = final.replace(/-\s{1,}/g, '');
	return final;
}