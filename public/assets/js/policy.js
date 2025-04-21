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
	getAllPolicies();
	$("#policies-table").DataTable({
		"columnDefs": [
        	{"className": "dt-center", "targets": "_all"},
        	{"render" : function(data, type, row){
				        		return "<span class='id'>" + data + "</span>";
				   		}, "targets" : 0 },
        	{"render" : function(data, type, row){
				        		return "<span class='title'>" + data + "</span>";
				   		}, "targets" : 1 },
        	{"render" : function(data, type, row){
				        		return "<span class='desc'>" + data + "</span>";
				   		}, "targets" : 2 },
        	{"render" : function(data, type, row){
				        		return "<span class='price' data='" + sliceNumber(data, 2) + "'>" + formatCurrency(sliceNumber(data, 2)) + "</span>";
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
			{title : "Nombre"},
			{title : "Descripción"},
			{title : "Precio"},
			{title : "Editar"},
			{title : "Eliminar"}
		],
		"fnDrawCallback": function( oSettings ) {
			$(".delete").off();
			$(".delete").on("click", deletePolicy );
			$(".edit").off();
			$(".edit").on("click", setUpdateComponent );
    	}
	});
});
function setCreateComponent(){
	clearForm();
	$("#create-instr").show();
	$("#update-instr").hide();
	$("#row-id").hide();
	$("#add-label").show();
	$("#update-label").hide();
	$("#action-btn span").text( "Guardar" );
	$("#action-btn").off();
	$("#action-btn").on("click", storePolicy );
}
function getAllPolicies(){
	$.get({
		url : route + "/all",
		processData : false,
		cache : false,
		success : function( response ){
			var data = response.data;
			showPolicies( data );
			$("#data-loader").remove();
		}
	});
}
function showPolicies( data ){
	var TABLE = $("#policies-table").DataTable();
	data.forEach(function(e){
		var array = new Array();
		array.push(e.id);
		array.push(e.titulo);
		array.push(e.descripcion);
		array.push(e.precio);
		array.push(e.id);
		array.push(e.id);
		TABLE.row.add( array );
	});
	TABLE.draw();
	$("#container").show();
}
function setUpdateComponent(event){
	clearForm();
	$("#create-instr").hide();
	$("#update-instr").show();
	$("#row-id").show();
	$("#add-label").hide();
	$("#update-label").show();
	$("#action-btn span").text( "Actualizar" );
	$("#action-btn").off();
	$("#action-btn").on("click", updatePolicy );

	var id = $(event.currentTarget).parents("tr").find(".id").text();
	var title = $(event.currentTarget).parents("tr").find(".title").text();
	var desc = $(event.currentTarget).parents("tr").find(".desc").text();
	var price = $(event.currentTarget).parents("tr").find(".price").attr("data");
	$("#id").val( id );
	$("#title").val( title );
	$("#desc").val( desc );
	$("#price").val( price );

	$("#update-btn-trigger").click();
}
function validateForm(){
	var valid_count = 0;
	$(".not-null").each(function(){
		checkInputEmptyness( $(this) ) ? null : valid_count-- ;
	});
	return valid_count >= 0;
}
function storePolicy(){
	$("#ajax-loader").show();
	if( validateForm() ){
		$.ajax({
			method : "POST",
			url : route,
			data : {
				"title" : $("#title").val(),
				"desc" : $("#desc").val(),
				"price" : $("#price").val() == "" ? "0" : $("#price").val()
			},
			success : function( response ){
				if( response.status ){
					swal("OK", "Póliza agregada correctamente", "success");
					var TABLE = $("#policies-table").DataTable();
					TABLE.row.add([
						response.id,
						$("#title").val(),
						$("#desc").val(),
						$("#price").val(),
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
function updatePolicy(){
	$("#ajax-loader").show();
	if( validateForm() ){
		$.ajax({
			method : "POST",
			url : route + "/" + $("#id").val(),
			data : {
				"title" : $("#title").val(),
				"desc" : $("#desc").val(),
				"price" : $("#price").val(),
				"_method" : "PUT"
			},
			success : function( response ){
				if( response.status ){
					$("#ajax-loader").hide();
					swal("OK", "Póliza actualizada correctamente", "success");
					var parents = $("#policies-table span:contains('" + $("#id").val() +  "')").parents("tr");
					parents.find(".title").text($("#title").val());
					parents.find(".desc").text($("#desc").val());
					parents.find(".price").text($("#price").val());
					$("#close").click();
				}
			}
		});
	}
}
function deletePolicy(event){
	var id = $(event.currentTarget).parents('tr').find(".id").text();
	$(event.currentTarget).attr("src", ajax_loader_route);
	$.ajax({
		method : "DELETE",
		url : route + "/" + id,
		success : function( response ){
			if( response.status ){
				swal("OK", "Póliza eliminada correctamente", "success");
				var row = $("#policies-table").DataTable().row( $(event.currentTarget).parents('tr') ).remove().draw();
			}
		}
	});
}
function clearForm(){
	$("#id").val("");
	$("#title").val("");
	$("#desc").val("");
}