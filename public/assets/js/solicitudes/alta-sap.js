

/**
*
* @author GerardoSteven (Steven0110)
*/
var persons = [];

$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip({trigger: "manual"});
	$("input.uppercase").on("keyup", upperCaseSet );
	$("input.not-null").on("focusout", checkInputEmptyness );
	$("input.url").on("focusout", checkInputURL );
	$("input.phone").on("focusout", checkInputPhone );
	$("input[type='email']").on("focusout", checkInputEmail );
	$("#copy-btn").on("click", copyFiscal )
	$("#cp-fiscal").on("keyup", {type : "fiscal"}, loadCPInfo );
	$("#cp-envio").on("keyup", {type : "envio"}, loadCPInfo );
	$("#success").on( "click", storeClientSAP );
	$("#add-person").on("click", addPerson);
});
function validateForm(){
	var valid_count = 0;
	$("input.not-null").each(function(){
		checkInputEmptyness( $(this) ) ? null : valid_count-- ;
	});
	$("input.url").each(function(){
		checkInputURL( $(this) ) ? null : valid_count-- ;
	});
	$("input.phone").each(function(){
		checkInputPhone( $(this) ) ? null : valid_count-- ;
	});
	$("input.email").each(function(){
		checkInputEmail( $(this) ) ? null : valid_count-- ;
	});
	console.log( valid_count );	
	return valid_count >= 0;
}
function storeClientSAP(){
	var formData = new FormData();

	formData.append("nombre_gral", $("#nombre_gral").val() );
	formData.append("rfc_gral", $("#rfc_gral").val() );
	formData.append("tel_gral", $("#tel_gral").val() );
	formData.append("email_gral", $("#email_gral").val() );
	formData.append("web_gral", $("#web_gral").val() );
	formData.append("persona_gral", $("#persona_gral").val() );

	formData.append("calle_fiscal", $("#calle-fiscal").val() );
	formData.append("colonia_fiscal", $("#colonia-fiscal").val() );
	formData.append("ciudad_fiscal", $("#ciudad-fiscal").val() );
	formData.append("municipio_fiscal", $("#municipio-fiscal").val() );
	formData.append("pais_fiscal", $("#pais-fiscal").val() );
	formData.append("cp_fiscal", $("#cp-fiscal").val() );

	formData.append("calle_envio", $("#calle-envio").val() );
	formData.append("colonia_envio", $("#colonia-envio").val() );
	formData.append("ciudad_envio", $("#ciudad-envio").val() );
	formData.append("mun_envio", $("#municipio-envio").val() );
	formData.append("pais_envio", $("#pais-envio").val() );
	formData.append("cp_envio", $("#cp-envio").val() );

	formData.append("personas", JSON.stringify(persons) );

	if( validateForm() ){
		$("#mail-loader").show();
		$.ajax({
			method : "POST",
			url : route,
			data : formData,
			contentType : false,
			processData : false,
			cache : false,
			success : function( response ){
				$("#mail-loader").hide();
				if( response.status === true ){
					clearForm();
					swal({
						title : "OK",
						text : "Cliente agregado correctamente a SAP",
						type : "success"
					});
				}else{
					swal({
						title : "Error",
						text : response,
						type : "error"
					});
				}
			}
		});
	}
}
function clearForm(){
	$("input.an-form-control").each(function(){
		$(this).val("");
		$(this).removeClass("danger");
		$(this).removeClass("ok");
		$(this).tooltip("hide");
		$($(this).siblings(".an-input-group-addon").find("i")).removeClass();
	});
}
function copyFiscal(){
	$("#calle-envio").val( $("#calle-fiscal").val() );
	$("#colonia-envio").val( $("#colonia-fiscal").val() );
	$("#ciudad-envio").val( $("#ciudad-fiscal").val() );
	$("#municipio-envio").val( $("#municipio-fiscal").val() );
	$("#pais-envio").val( $("#pais-fiscal").val() );
	$("#cp-envio").val( $("#cp-fiscal").val() );

	$("[id$=envio], [id$=fiscal]").each(function(){
		$(this).focusout();
	});
}
function loadCPInfo( event ){
	var cp_search = $(event.currentTarget).val();
	if( cp_search.length >= 4 ){
		$("#cp-img-" + event.data.type ).show();
		ajaxCP( cp_search, event.data.type );
	}
}
function setAddress( data, type ){
	$("#cp-img-" + type ).hide();
	$("#municipio-" + type ).val( data.municipio );
	$("#municipio-" + type ).focusout();
	$("#colonia-" + type ).val( data.colonia );
	$("#colonia-" + type ).focusout();
}
function ajaxCP( cp, type ){
	var input = $("#cp-" + type );
	$.ajax({
		url : "/getCP/" + cp,
		method : "GET",
		cache : false,
		contentType : false,
		processData : false,
		success : function( response ){
			if( response.status === true ){	
				setAddress( response.data, type );
				switchInput(
			     	input,
			     	$(input.siblings(".an-input-group-addon").find("i")), 
			     	true, 
			    	""
			    ); 
			}
			else{
				$("#cp-img-" + type ).hide();
				switchInput(
			     	input,
			     	$(input.siblings(".an-input-group-addon").find("i")), 
			     	false, 
			    	"El código postal no es válido"
			    ); 
			}
		}
	});	
}

function addPerson(){
	var tipo = $("#tipo_persona").val();
	var nombre = $("#nombre_persona").val();
	var email = $("#email_persona").val();
	var telefono = $("#phone_persona").val();

	persons.push(
		{
			"tipo": tipo,
			"nombre": nombre,
			"email": email,
			"telefono": telefono
		}
	);

	$("#persons-container").empty();
	persons.forEach(function(e){
		$("#persons-container").append($("<div class='col-md-2'><div class='an-input-group'><div class='an-input-group-addon'><i></i></div><input value='"+e.tipo+"' type='text' disabled class='an-form-control'></div></div><div class='col-md-3'><div class='an-input-group'><div class='an-input-group-addon'><i></i></div><input type='text' value='"+e.nombre+"' disabled class='an-form-control'></div></div><div class='col-md-3'><div class='an-input-group'><div class='an-input-group-addon'><i></i></div><input type='text' value='"+e.email+"' disabled class='an-form-control'></div></div><div class='col-md-3'><div class='an-input-group'><div class='an-input-group-addon'><i></i></div><input type='text' value='"+e.telefono+"' disabled class='an-form-control'></div></div><div class='col-md-1'><button onclick='deletePerson(\""+e.tipo+"\")' class='btn btn-xs an-btn-danger btn-block'>Quitar</button></div>"));
	});
	
}

function deletePerson(tipo){
	persons = persons.filter(function(item) { 
	   return item.tipo !== tipo;  
	});

	$("#persons-container").empty();
	persons.forEach(function(e){
		$("#persons-container").append($("<div class='col-md-2'><div class='an-input-group'><div class='an-input-group-addon'><i></i></div><input value='"+e.tipo+"' type='text' disabled class='an-form-control'></div></div><div class='col-md-3'><div class='an-input-group'><div class='an-input-group-addon'><i></i></div><input type='text' value='"+e.nombre+"' disabled class='an-form-control'></div></div><div class='col-md-3'><div class='an-input-group'><div class='an-input-group-addon'><i></i></div><input type='text' value='"+e.email+"' disabled class='an-form-control'></div></div><div class='col-md-3'><div class='an-input-group'><div class='an-input-group-addon'><i></i></div><input type='text' value='"+e.telefono+"' disabled class='an-form-control'></div></div><div class='col-md-1'><button onclick='deletePerson(\""+e.tipo+"\")' class='btn btn-xs an-btn-danger btn-block'>Quitar</button></div>"));
	});
}
function deleteAllPersons(){
	persons = [];
	$("#persons-container").empty();
}