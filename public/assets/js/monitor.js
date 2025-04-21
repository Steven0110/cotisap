$(document).ready(function(){
	loadListeners();
});
function loadListeners(){
	loadSelectListener();
	$("#slp").on("select2:select", function(){$("#search").removeAttr("disabled")});
	$("#search").on("click", searchProgress );
}
function loadSelectListener(){
	$("#slp").select2({
		ajax: {
			url: route + "/getSLP",
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
		placeholder: 'Introduzca un nombre ...',
		minimumInputLength: 3,
		language: 'es'
    });
}
function searchProgress(){
	var slp = $("select#slp option").val();
	var aux_date = $("div#reportrange span.hidden").text();
	var from = aux_date.split("&")[0];
	var to = aux_date.split("&")[1];
	$("#progress-table").find("tbody").empty();
	$("#progress-table-loader").show();
	$.ajax({
		method : "GET",
		url : getProgress,
		data : {
			"slp" : slp,
			"from" : from,
			"to" : to
		},
		success : function( response ){
			if(response.status){
				$("strong#slpname").text( $("select#slp option:last-child").text() );
				var TABLE = $("#progress-table");
				response.progress.forEach(function(e){
					console.log( e );
					var TR = $("<tr></tr>");
					var TD_QUOT = $("<td>" + e.quotation.numCotizacion + "</td>");
					var TD_DATE = $("<td>" + e.quotation.created_at + "</td>");
					var TD_BAR = $("<td colspan='7'></td>");
					var PROGRESS_BAR = $("<ul id='progressbar'></ul>");
					var STATUS_Q = $("<li" + (e.progress.Q === "1" ? " class='active'><a href='#'  target='_blank'>Ver</a>" : ">") + "</li>"); 	//Oferta
					var STATUS_P = $("<li" + (e.progress.P === "1" ? " class='active'" : "") + "></li>"); 	//Pago
					var STATUS_R = $("<li" + (e.progress.R === "1" ? " class='active'" : "") + "></li>"); 	//Pedido
					var STATUS_D = $("<li" + (e.progress.D === "1" ? " class='active'><a href='" + entregas + "?id=" + e.progress.Dnum + "' target='_blank'>Ver</a>" : ">") + "</li>"); 	//
					var STATUS_C = $("<li" + (e.progress.C === "1" ? " class='active'><a href='" + entregas + "?id=" + e.progress.Dnum + "' target='_blank'>Ver</a>" : ">") + "</li>"); 	//Entrega
					var STATUS_I = $("<li" + (e.progress.I === "1" ? " class='active'><a href='" + facturas + "?id=" + e.progress.Inum + "' target='_blank'>Ver</a>" : ">") + "</li>"); 	//En camino
					var STATUS_S = $("<li></li>"); 	//Pago
					PROGRESS_BAR.append( STATUS_Q );
					PROGRESS_BAR.append( STATUS_P );
					PROGRESS_BAR.append( STATUS_R );
					PROGRESS_BAR.append( STATUS_D );
					PROGRESS_BAR.append( STATUS_C );
					PROGRESS_BAR.append( STATUS_I );
					PROGRESS_BAR.append( STATUS_S );
					TD_BAR.append( PROGRESS_BAR );
					TR.append( TD_QUOT );
					TR.append( TD_DATE );
					TR.append( TD_BAR );
					TABLE.append( TR );
				});
				$("#progress-table-loader").hide();
				
			}
			//deploy( response );
		}
	});
}
function deploy( data ){
	var e = [
		{"numCotizacion" : "698547", "created_at" : "2017-10-17 18:50:52"},
		{"numCotizacion" : "615842", "created_at" : "2018-10-17 28:50:52"},
	]
	var test_progress = [
		{ "Q": 0, "P": 0, "R": 0, "Rnum": null, "D": 1, "Dnum": 1000001, "C": 0, "Cnum": null, "I": 0, "Inum": null },
		{ "Q": 0, "P": 0, "R": 1, "Rnum": null, "D": 1, "Dnum": 1000000, "C": 1, "Cnum": null, "I": 1, "Inum": 1454 }
	];

				
}