

/**
* 
  [
    'Developer' => 'Gerardo Aramis Cabello Acosta',
    'GitHub'    => 'https://github.com/Steven0110/'
  ]
*/
var lang_ES_EN = {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Sin información en un rango de 45 días a la fecha",
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
var quotations_salesperson_chart;
var products_salesperson_chart;
var quotations_status_salesperson_chart;
var hitrate_salesperson_chart;
$(document).ready(function(){
	getDaysLeft();
	loadCarousel();
	loadPartners();
	loadKPI();
	geolocate();
	KPIGeneralHitrate();
	initSPKPI();
	KPIStatements();
});
function getDaysLeft(){
	var date = new Date();
	var lastDay = (new Date(date.getFullYear(), date.getMonth() + 1, 0)).getDate();
	var currentDay = date.getDate();
	var diff = lastDay - currentDay;
	var days = "", text = "";
	if( diff == 1 ){
		days = 1 + " día";
		text = "Para cierre de mes";
	}else if( diff == 0 ){
		days = "Hoy";
		text = "es cierre de mes";		
	}else{
		days = diff + " días";
		text = "Para cierre de mes";		
	}
	$("#days-left").text(days);
	$("#days-left-text").text(text);
}
function geolocate(){
	if(navigator.geolocation){
		navigator.geolocation.getCurrentPosition(showPosition);
	}else{
		$("#location").text("NO SOPORTADO");
	}
}
function showPosition( position ){
	var lat = position.coords.latitude;
	var lng = position.coords.longitude;
	delete $.ajaxSettings.headers["X-CSRF-TOKEN"];
	$.ajax({
		method : "GET",
		type : "GET",
		url : "https://maps.googleapis.com/maps/api/geocode/json",
		data : {
			"latlng" : lat + ',' + lng,
			"key" : "AIzaSyCT1gj_mVzGedVVgNx-RJVpz5YyhcYw0LU"
		},
		success : function( response ) {
			$("#location").text(
				response.results[0].address_components[4].short_name + 
				", " +
				response.results[0].address_components[5].short_name
			);
			$.ajaxSettings.headers["X-CSRF-TOKEN"] = $('meta[name="csrf-token"]').attr('content'); // Add it back immediately
		}
	});
}
function loadPartners(){
	$.ajax({
		method : "GET",
		url : getPartners,
		success : function(response){
			var SELECT = $("<select id='partner' class='an-form-control success partners'></select>");
			if(response.length == 0){
				var OPTION = $("<option value='-1'>Sin socios de negocios</option>");
				SELECT.append( OPTION.clone() );
			}else{
				response.forEach(function(e){
					var OPTION = $("<option value='" + 
						e.cardcode + 
						"'>" + e.cardcode + " - " + e.cardname + "</option>");
					SELECT.append( OPTION.clone() );
				});
			}
			SELECT.on("change", updateStatement );
			$("#partner-wrapper").append( SELECT );
			KPIStatements();
		}
	});
}
function loadKPI(){
	var labels = ["Cotizadas y ganadas", "Perdidas y negociando"];
	var quotation_labels = ["Cotizadas", "Negociando", "Ganadas", "Perdidas"];
	
	const xValues = [100,200,300,400,500,600,700,800,900,1000];
	var general_quotations = new Chart(document.getElementById("general-quotations-graph").getContext('2d'), 
	{
		type: "line",
		data: {
		  labels: xValues,
		  datasets: [{
			data: [860,1140,1060,1060,1070,1110,1330,2210,7830,2478],
			borderColor: "red",
			fill: false
		  },{
			data: [1600,1700,1700,1900,2000,2700,4000,5000,6000,7000],
			borderColor: "green",
			fill: false
		  },{
			data: [300,700,2000,5000,6000,4000,2000,1000,200,100],
			borderColor: "blue",
			fill: false
		  }]
		},
		options: {
		  legend: {display: false}
		}
	  }
	);

	$("#gq-loader").hide();
	$("#ghr-loader").hide();

	var general_quotations_status = new Chart(
		document.getElementById("general-hitrate-graph").getContext("2d"), {
			type: 'doughnut',
			data: {
				labels: [
				  'Cotizadas y ganadas',
				  'Perdidas y negociando',
				  'Sin estatus'
				],
				datasets: [{
				  label: 'Forecast',
				  data: [300, 50, 100],
				  backgroundColor: [
					'#098e2b',
					'#e53935',
					'#f7d943'
				  ],
				  hoverOffset: 4
				}]
			  },
			options : {
				tooltips : {
					callbacks : {
						label : function( tooltips ){
							var percentage = (qg_np[tooltips.index] * 100 / total)
							percentage = percentage.toString();
							percentage = percentage.slice( 0, (percentage.indexOf(".")) + 3 );
							percentage = percentage + "%";
							var quotations = "Cotizaciones: " + qg_np[ tooltips.index ];
							return new Array( quotations, percentage );
						}
					}
				}
			}
	});

	/******************************* AJAX FOR KPI INFO ***************************************/
	$.ajax({
		method : "GET",
		url : getGralInfo,
		success : function( response ){
			console.log( response );
			if( response.status ){
				return ;
				//////////////////////////////// Top KPI
				$("#total_quotations").text(response.total_quotations.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
				$("#total_quotations").show();
				$("#tq_loader").hide();
				if( response.last_quotation == null ){
					$("#last_quotation").text("N/A");
					$("#last_quotation").show();
					$("#last_quotation_link").hide();
					$("#lq_loader").hide();	
				}else{
						
					/********************************** CONSTRUIR COOKIE DE KPIs ***********************************/
					if($.cookie("kpi") == undefined ){
						var date = new Date();
						date.setTime(date.getTime() + ( 24 * 60 * 60 * 1000));
						var kpi = {
							"sidebar" : {
								"fch" : Math.floor(Number(response.FCH))		//FCH
							}
						};
						$.cookie("kpi", JSON.stringify( kpi ), { expires: date });

						/************************************ FCH **************************************/
						$("#fch img").hide();
						$("#fch").text( JSON.parse($.cookie("kpi")).sidebar.fch );
					}
					/********************************** CONSTRUIR COOKIE DE KPIs ***********************************/
					$("#last_quotation").text("$" + response.last_quotation.total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") );
					$("#last_quotation").show();
					$("#last_quotation_link").attr("href", show_q.replace("XXX", response.last_quotation.numCotizacion));
					$("#lq_loader").hide();
				}

				//////////////////////////////// Sales Persons
				var SELECT = $("<select id='salesperson' class='an-form-control success salespersons'></select>");
	        	var mixed_array = response.actives.concat(response.inactives);
	        	if(mixed_array.length > 0){
		        	mixed_array.forEach(function(e){
						var OPTION = $("<option value='" + 
							e.id + "'>" + e.text + "</option>");
						SELECT.append( OPTION.clone() );
		        	});
	        	}else{
					var OPTION = $("<option value='-1'>Sin vendedores a cargo</option>");

	        	}
				SELECT.on("change", updateSPCharts );
				$(".salespersons-wrapper").append( SELECT );

				//////////////////////////////// General Top Quotations
				if(response.top_quotations.length > 0){
					var names = new Array();
					var totals = new Array();
					var id = new Array();
					var estatus = new Array();
					response.top_quotations.forEach(function(e){
						names.push(e.nombreCliente);
						totals.push(e.total);
						id.push(e.numCotizacion);
						estatus.push(e.estatus);
					});

					var general_quotations = new Chart(
						document.getElementById("general-quotations-graph").getContext('2d'), 
						{
						    type: 'bar',
						    data: {
						        labels: names,
						        datasets: [{
						            label: 'Top Cotizaciones de ' + company,
						            data: totals,
						            backgroundColor: 'rgba(233,66,110, 1)',
						            borderColor: 'rgba(233,66,110,1)',
						            borderWidth: 1
						        }]
					    },
					    options: {
					    	onClick : function(event){
					    		var index = general_quotations.getElementAtEvent(event)[0]["_index"];
					    		window.open( show_q.replace("XXX", id[ index ]), "_blank");
					    	},
					        scales: {
					            yAxes: [{
					                ticks: {	
						    			callback : function(value, index, values){
						    				return  '$' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
						    			},
						    			beginAtZero: true
						    		}
						    	}],
						    	xAxes: [{
					                ticks: {	
						    			callback : function(value, index, values){
						    				return  shortify( value, 10 );
						    			}
						    		}
						    	}]
						    },
						    tooltips : {
						    	callbacks : {
						    		title: function(tooltipItems, data) {
						    			if( names[tooltipItems[0].index].length >= 49)
				                			return shortify(names[tooltipItems[0].index], 45);
				                		else
				                			return names[tooltipItems[0].index];
				            		},
				            		label : function(tooltipItems, data){
				            			var monto = "Monto: " + '$' +  totals[tooltipItems.index].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " MXN";
				  						var id_item = "ID: " + id[tooltipItems.index];
				  						var estatus_item = "Estatus: " + getStatus(estatus[tooltipItems.index]);
				            			return new Array( monto, id_item, estatus_item );
				            		}
						    	}
						    }
						}
					});
				}else{
					$("#general-quotations-graph").hide();
					$("<h3 class='text-center'>Sin cotizaciones arriba de $100'000 MXN</h3>").insertAfter("#general-quotations-graph");
				}
				$("#gq-loader").hide();
				//////////////////////////////// General Hitrate
				var status = response.hitrate;
				var qg_np = [ status[0] + status[2], status[1] + status[3] ];
				var total = status[0] + status[1] + status[2] + status[3];
				if(total == 0){
					$("#general-quotations-status-graph").hide();
					$("#general-hitrate-graph").hide();
					$("<h3 class='text-center'>Sin cotizaciones</h3>").insertAfter("#general-quotations-graph");
					$("<h3 class='text-center'>Sin cotizaciones</h3>").insertAfter("#general-hitrate-graph");

				}else{
					var general_quotations_status = new Chart(
						document.getElementById("general-hitrate-graph").getContext("2d"), {
					    	type: 'doughnut',
						    data: {
						    	datasets : [{
							        data: qg_np,
							        backgroundColor	: [
							        	'#098e2b',
							        	'#e53935',
							        ],
							        borderColor : [
							        	'#098e2b',
							        	'#e53935',
							        ],
						            borderWidth: 1
							    }],
						    	labels : labels
						    },
						    options : {
						    	tooltips : {
						    		callbacks : {
							    		label : function( tooltips ){
							    			var percentage = (qg_np[tooltips.index] * 100 / total)
											percentage = percentage.toString();
											percentage = percentage.slice( 0, (percentage.indexOf(".")) + 3 );
											percentage = percentage + "%";
											var quotations = "Cotizaciones: " + qg_np[ tooltips.index ];
							    			return new Array( quotations, percentage );
							    		}
						    		}
						    	}
						    }
					});
					var general_quotations_status = new Chart(
					document.getElementById("general-quotations-status-graph").getContext("2d"), {
				    	type: 'doughnut',
					    data: {
					    	datasets : [{
						        data: status, 
						        backgroundColor	: [
						        	'#098e2b',
						        	'#f7d943',
						        	'#4fc3f7',
						        	'#e53935'
						        ],
						        borderColor : [
						        	'#098e2b',
						        	'#f7d943',
						        	'#4fc3f7',
						        	'#e53935'
						        ],
					            borderWidth: 1
						    }],
					    	labels : quotation_labels
					    }
					});
				}
				$("#gqs-loader").hide();	
				$("#ghr-loader").hide();
				initMansoi();
				initSPKPI();
			}
		}
	});	
}
function initSPKPI(){
	var kpi_1 = true, kpi_2 = true, kpi_3 = true, kpi_4 = true;
	var slpcode = $("#salesperson option").first().val();
	var slpname = $("#salesperson option").first().text();
	//var labels = ["Cotizadas y ganadas", "Perdidas y negociando"];
	var quotation_labels = ["Cotizadas", "Negociando", "Ganadas", "Perdidas"];

	const labels = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio"];
	const data = {
		labels: labels,
		datasets: [{
			label: 'Cotizaciones por mes',
			data: [65, 59, 80, 81, 56, 55, 40],
			backgroundColor: [
			'rgba(255, 99, 132, 0.2)',
			'rgba(255, 159, 64, 0.2)',
			'rgba(255, 205, 86, 0.2)',
			'rgba(75, 192, 192, 0.2)',
			'rgba(54, 162, 235, 0.2)',
			'rgba(153, 102, 255, 0.2)',
			'rgba(201, 203, 207, 0.2)'
			],
			borderColor: [
			'rgb(255, 99, 132)',
			'rgb(255, 159, 64)',
			'rgb(255, 205, 86)',
			'rgb(75, 192, 192)',
			'rgb(54, 162, 235)',
			'rgb(153, 102, 255)',
			'rgb(201, 203, 207)'
			],
			borderWidth: 1
		}]
	};
	const dataP = {
		labels: ["Product 1", "Product 2", "Product 3", "Product 4", "Product 5", "Product 6", "Product 7"],
		datasets: [{
			label: 'Cotizaciones por producto',
			data: [67, 83, 41, 95, 52, 78, 36],
			backgroundColor: [
				'rgba(255, 99, 132, 0.2)',
				'rgba(255, 159, 64, 0.2)', 
				'rgba(255, 205, 86, 0.2)',
				'rgba(75, 192, 192, 0.2)',
				'rgba(54, 162, 235, 0.2)',
				'rgba(153, 102, 255, 0.2)',
				'rgba(201, 203, 207, 0.2)'
			],
			borderColor: [
				'rgb(255, 99, 132)',
				'rgb(255, 159, 64)',
				'rgb(255, 205, 86)', 
				'rgb(75, 192, 192)',
				'rgb(54, 162, 235)',
				'rgb(153, 102, 255)',
				'rgb(201, 203, 207)'
			],
			borderWidth: 1
		}]
	};

	quotations_salesperson_chart = new Chart(
		document.getElementById("quotations-salesperson-graph").getContext("2d"),{
			type: 'bar',
			data: data,
			options: {
				scales: {
				y: {
					beginAtZero: true
				}
				}
			},
		}
	);
	
	products_salesperson_chart = new Chart(
		document.getElementById("products-salesperson-graph").getContext("2d"),{
			type: 'bar',
			data: dataP,
			options: {
				scales: {
				y: {
					beginAtZero: true
				}
				}
			},
		}
	);


	$.ajax({
		method : "GET",
		url : getSLPInfo,
		data : {"slpcode" : slpcode},
		success : function( response ){
			//console.log( response );
			if( response.status ){				
				///////////////////////////////Top 10 Quotations
				if( response.top_quotations.length > 0 ){
					var names = new Array();
					var totals = new Array();
					var id = new Array();
					var estatus = new Array();
					response.top_quotations.forEach(function(e){
						names.push(e.nombreCliente);
						totals.push(e.total);
						id.push(e.numCotizacion);
						estatus.push(e.estatus);
					});
					quotations_salesperson_chart = new Chart(
						document.getElementById("quotations-salesperson-graph").getContext("2d"),{
						    type: 'bar',
						    data: {
						        labels: shortifyArray(names, 10),
						        datasets: [{
						            label: 'Cotizaciones más altas de ' + slpname,
						            data: totals,
						            backgroundColor: 'rgba(233,66,110, 1)',
						            borderColor: 'rgba(233,66,110,1)',
						            borderWidth : 1
						        }]
						    },
						    options: {
						    	onClick : function(event){
						    		var index = quotations_salesperson_chart.getElementAtEvent(event)[0]["_index"];
						    		window.open( show_q.replace("XXX", id[ index ]), "_blank");
						    	},
						    	tooltips : {
						    		callbacks : {
						    			title : function(tooltipItems, data) {
							    			if( names[tooltipItems[0].index].length >= 49)
					                			return shortify(names[tooltipItems[0].index], 45);
					                		else
					                			return names[tooltipItems[0].index];
				            			},
				            			label : function(tooltipItems){
					            			var monto = "Monto: " + '$' +  totals[tooltipItems.index].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " MXN";
					  						var id_item = "ID: " + id[tooltipItems.index];
					  						var estatus_item = "Estatus: " + getStatus(estatus[tooltipItems.index]);
					            			return new Array( monto, id_item, estatus_item );
				            			}
						    		}
						    	},
						    	scales : {
						            yAxes: [{
						                ticks: {	
							    			callback : function(value, index, values){
							    				return  '$' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
							    			},
						    				beginAtZero: true
							    		}
							    	}],
							    	xAxes: [{
						                ticks: {	
							    			callback : function(value, index, values){
							    				return  shortify( value, 10 );
							    			}
							    		}
							    	}]
						    	}
						    }   
						}
					);
				}else{
					kpi_1 = false;
					quotations_salesperson_chart = new Chart(
						document.getElementById("quotations-salesperson-graph").getContext("2d"),{
						    type: 'bar',
						    data: {
						        labels: [],
						        datasets: [{
						            label: 'Cotizaciones más altas de ' + '...',
						            data: [],
						            backgroundColor: 'rgba(233,66,110, 1)',
						            borderColor: 'rgba(233,66,110,1)',
						            borderWidth : 1
						        }]
						    },
						    options: {
						    	onClick : function(event){
						    		var index = quotations_salesperson_chart.getElementAtEvent(event)[0]["_index"];
						    		window.open( show_q.replace("XXX", id[ index ]), "_blank");
						    	},
						    	tooltips : {
						    		callbacks : {
						    			title : function(tooltipItems, data) {
							    			if( names[tooltipItems[0].index].length >= 49)
					                			return shortify(names[tooltipItems[0].index], 45);
					                		else
					                			return names[tooltipItems[0].index];
				            			},
				            			label : function(tooltipItems){
					            			var monto = "Monto: " + '$' +  totals[tooltipItems.index].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " MXN";
					  						var id_item = "ID: " + id[tooltipItems.index];
					  						var estatus_item = "Estatus: " + getStatus(estatus[tooltipItems.index]);
					            			return new Array( monto, id_item, estatus_item );
				            			}
						    		}
						    	},
						    	scales : {
						            yAxes: [{
						                ticks: {	
							    			callback : function(value, index, values){
							    				return  '$' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
							    			},
						    				beginAtZero: true
							    		}
							    	}],
							    	xAxes: [{
						                ticks: {	
							    			callback : function(value, index, values){
							    				return  shortify( value, 10 );
							    			}
							    		}
							    	}]
						    	}
						    }   
						}
					);
					$("#quotations-salesperson-graph").hide();
					$("<h3 class='text-center'>Sin cotizaciones arriba de $100'000 MXN</h3>").insertAfter("#quotations-salesperson-graph");
				}

				///////////////////////////////Top 10 products
				if(response.top_products.length > 0){
					var p_names = new Array();
					var quantities = new Array();
					response.top_products.forEach(function(e){
						p_names.push(e.nombreArt);
						quantities.push(e.total);
					});
					products_salesperson_chart = new Chart(
						document.getElementById("products-salesperson-graph").getContext("2d"),{
						    type: 'bar',
						    data: {
						        labels: shortifyArray(p_names, 10),
						        datasets: [{
						            label: 'Productos más vendidos de ' + slpname,
						            data: quantities,
						            backgroundColor: 'rgba(233,66,110, 1)',
						            borderColor: 'rgba(233,66,110,1)',
						            borderWidth : 1
						        }]
						    },
						    options: {
						    	tooltips : {
						    		callbacks : {
						    			title : function(tooltipItems) {
							    			if( p_names[tooltipItems[0].index].length >= 49)
					                			return shortify(p_names[tooltipItems[0].index], 45);
					                		else
					                			return p_names[tooltipItems[0].index];
				            			},
				            			label : function(tooltipItems){
				            				return "Cantidad: " + quantities[ tooltipItems.index ] ;
				            			}
						    		}
						    	},
						    	scales : {
						    		yAxes: [{
						                ticks: {	
							    			callback : function(value, index, values){
							    				return  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
							    			},
						    				beginAtZero: true
							    		}
							    	}],
							    	xAxes: [{
						                ticks: {	
							    			callback : function(value, index, values){
							    				return  shortify( value, 10 );
							    			}
							    		}
							    	}]
						    	}
						    }
						}
					);
				}else{
					kpi_2 = false;

					products_salesperson_chart = new Chart(
						document.getElementById("products-salesperson-graph").getContext("2d"),{
						    type: 'bar',
						    data: {
						        labels: [],
						        datasets: [{
						            label: 'Productos más vendidos de ' + slpname,
						            data: [],
						            backgroundColor: 'rgba(233,66,110, 1)',
						            borderColor: 'rgba(233,66,110,1)',
						            borderWidth : 1
						        }]
						    },
						    options: {
						    	tooltips : {
						    		callbacks : {
						    			title : function(tooltipItems) {
							    			if( p_names[tooltipItems[0].index].length >= 49)
					                			return shortify(p_names[tooltipItems[0].index], 45);
					                		else
					                			return p_names[tooltipItems[0].index];
				            			},
				            			label : function(tooltipItems){
				            				return "Cantidad: " + quantities[ tooltipItems.index ] ;
				            			}
						    		}
						    	},
						    	scales : {
						    		yAxes: [{
						                ticks: {	
							    			callback : function(value, index, values){
							    				return  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
							    			},
						    				beginAtZero: true
							    		}
							    	}],
							    	xAxes: [{
						                ticks: {	
							    			callback : function(value, index, values){
							    				return  shortify( value, 10 );
							    			}
							    		}
							    	}]
						    	}
						    }
						}
					);
					$("#products-salesperson-graph").hide();
					$("<h3 class='text-center'>Sin productos</h3>").insertAfter("#products-salesperson-graph");					
				}

				///////////////////////////////Hitrate & Quotation Status
				var status = response.hitrate;
				var qg_np = [ status[0] + status[2], status[1] + status[3] ];
				var total = status[0] + status[1] + status[2] + status[3];
				if( total == 0){
					kpi_3 = kpi_4 = false;
					quotations_status_salesperson_chart = new Chart(
						document.getElementById("quotations-status-salesperson-graph").getContext("2d"), {
					    	type: 'doughnut',
						    data: {
						    	datasets : [{
							        data: [],
							        backgroundColor	: [
							        	'#098e2b',
							        	'#e53935',
							        ],
							        borderColor : [
							        	'#098e2b',
							        	'#e53935',
							        ],
						            borderWidth: 1
							    }],
						    	labels : labels
						    },
						    options : {
						    	tooltips : {
						    		callbacks : {
							    		label : function( tooltips ){
							    			var percentage = (qg_np[tooltips.index] * 100 / total);
											percentage = percentage.toString();
											var inc = percentage.indexOf(".") < 0 ? 1 : 0;
											percentage = percentage.slice( 0, (percentage.indexOf(".")) + 3 + inc );
											percentage = percentage + "%";
											var quotations = "Cotizaciones: " + qg_np[ tooltips.index ];
							    			return new Array( quotations, percentage );
							    		}
						    		}
						    	}
						    }
					});
					hitrate_salesperson_chart = new Chart(
					document.getElementById("hitrate-salesperson-graph").getContext("2d"), {
				    	type: 'doughnut',
					    data: {
					    	datasets : [{
						        data: [], 
						        backgroundColor	: [
						        	'#098e2b',
						        	'#f7d943',
						        	'#4fc3f7',
						        	'#e53935'
						        ],
						        borderColor : [
						        	'#098e2b',
						        	'#f7d943',
						        	'#4fc3f7',
						        	'#e53935'
						        ],
					            borderWidth: 1
						    }],
					    	labels : quotation_labels
					    }
					});
					$("#hitrate-salesperson-graph").hide();
					$("#quotations-status-salesperson-graph").hide();
					$("<h3 class='text-center'>Sin cotizaciones</h3>").insertAfter("#hitrate-salesperson-graph");
					$("<h3 class='text-center'>Sin cotizaciones</h3>").insertAfter("#quotations-status-salesperson-graph");
				}else{
					quotations_status_salesperson_chart = new Chart(
						document.getElementById("quotations-status-salesperson-graph").getContext("2d"), {
					    	type: 'doughnut',
						    data: {
						    	datasets : [{
							        data: qg_np,
							        backgroundColor	: [
							        	'#098e2b',
							        	'#e53935',
							        ],
							        borderColor : [
							        	'#098e2b',
							        	'#e53935',
							        ],
						            borderWidth: 1
							    }],
						    	labels : labels
						    },
						    options : {
						    	tooltips : {
						    		callbacks : {
							    		label : function( tooltips ){
							    			var percentage = (qg_np[tooltips.index] * 100 / total);
											percentage = percentage.toString();
											var inc = percentage.indexOf(".") < 0 ? 1 : 0;
											percentage = percentage.slice( 0, (percentage.indexOf(".")) + 3 + inc );
											percentage = percentage + "%";
											var quotations = "Cotizaciones: " + qg_np[ tooltips.index ];
							    			return new Array( quotations, percentage );
							    		}
						    		}
						    	}
						    }
					});
					hitrate_salesperson_chart = new Chart(
					document.getElementById("hitrate-salesperson-graph").getContext("2d"), {
				    	type: 'doughnut',
					    data: {
					    	datasets : [{
						        data: status, 
						        backgroundColor	: [
						        	'#098e2b',
						        	'#f7d943',
						        	'#4fc3f7',
						        	'#e53935'
						        ],
						        borderColor : [
						        	'#098e2b',
						        	'#f7d943',
						        	'#4fc3f7',
						        	'#e53935'
						        ],
					            borderWidth: 1
						    }],
					    	labels : quotation_labels
					    }
					});
				}
				$("#slp-loader").hide();
				if( !areEmptyKPI([kpi_1, kpi_2, kpi_3, kpi_4]) ){
					$("#salespersons-container").empty();
					$("#salespersons-container").append($("<h3 class='text-center'>Sin información</h3>"));
				}
				initMansoi();
			}
		}
	});
}
function updateSPCharts( event ){

	var slpcode = $(event.currentTarget).find("option:selected").val();
	var slpname = $(event.currentTarget).find("option:selected").text();
	var labels = ["Cotizadas y ganadas", "Perdidas y negociando"];
	var quotation_labels = ["Cotizadas", "Negociando", "Ganadas", "Perdidas"];
	$("#slp-loader").show();
	$.ajax({
		method : "GET",
		url : getSLPInfo,
		data : {"slpcode" : slpcode},
		success : function( response ){
			if( response.status ){				
				///////////////////////////////Top 10 Quotations
				var names = new Array();
				var totals = new Array();
				var id = new Array();
				var estatus = new Array();
				response.top_quotations.forEach(function(e){
					names.push(e.nombreCliente);
					totals.push(e.total);
					id.push(e.numCotizacion);
					estatus.push(e.estatus);
				});
				var info = {
					"id" : id,
					"estatus" : estatus
				};
				replaceQuotationData( quotations_salesperson_chart, names, totals, info);

				///////////////////////////////Top 10 products
				names = new Array();
				var quantities = new Array();
				response.top_products.forEach(function(e){
					names.push(e.nombreArt);
					quantities.push(e.total);
				});
				replaceProductsData( products_salesperson_chart, names, quantities );

				///////////////////////////////Hitrate & Quotation Status
				var status = response.hitrate;
				var qg_np = [ status[0] + status[2], status[1] + status[3] ];
				var total = status[0] + status[1] + status[2] + status[3];
				replaceSPHitrateData(hitrate_salesperson_chart, status);
				replaceSPQuotationStatusData(quotations_status_salesperson_chart, qg_np, qg_np, total);
				$("#slp-loader").hide();
			}
		}
	});
}
function loadCarousel(){
	for( var i = 0 ; i < 5 ; i++ ){
		var div = $("<div class='item text-center'></div>");
		var img = $("<img src='assets/img/alianza-logo2.png'>");
		div.append( img );
		$("div#slider-carousel").append( div ).ready(function (){
			initMansoi();
		});
	}

	if ($('.default-slider').length > 0) {
		$('.default-slider').owlCarousel({
			  items: 1,
			  singleItem: true,
			  autoPlay: true,
			  navigation: true,
			  navigationText: ['&#xe934', '&#xe932'],
			  pagination: false,
		});
	  }

	$(".owl-carousel").each(function(index, el) {
		var containerHeight = $(el).height();
		var aux = Number( $(".owl-item").width()) - 20;
		$(el).find("img").each(function(index, img) {
		  var w = $(img).prop('width');
		  var h = $(img).prop('height');
		  $(img).css({
			'width': aux + 'px',
			'height': '300px'
		  });
		}),
		$(el).owlCarousel({
		  autoWidth: true
		});
	});

	$.ajax({
		method : "GET",
		url : route + "/administracion/slider/all",
		processData : false,
		cache : false,
		success : function( response ){
			var sliders = response.data;
			// for( var i = 0 ; i < sliders.length ; i++ ){
			// 	if( sliders[ i ].status != 0 ){
			// 		sliders[ i ].archivo = sliders[ i ].archivo.replace("public", "storage");
			// 		var div = $("<div class='item text-center'></div>");
			// 		var img = $("<img src='/assets/img/projects.jpeg'>");
			// 		div.append( img );
			// 		$("div#slider-carousel").append( div ).ready(function (){
			// 			initMansoi();
			// 		});
			// 	}
			// }
  			if ($('.default-slider').length > 0) {
    			$('.default-slider').owlCarousel({
      				items: 1,
      				singleItem: true,
      				autoPlay: true,
      				navigation: true,
      				navigationText: ['&#xe934', '&#xe932'],
      				pagination: false,
    			});
  			}
  			$(".owl-carousel").each(function(index, el) {
			    var containerHeight = $(el).height();
			    var aux = Number( $(".owl-item").width()) - 20;
			    $(el).find("img").each(function(index, img) {
			      var w = $(img).prop('width');
			      var h = $(img).prop('height');
			      $(img).css({
			        'width': aux + 'px',
			        'height': '300px'
			      });
			    }),
			    $(el).owlCarousel({
			      autoWidth: true
			    });
			});
		}
	});
}
function KPIGeneralHitrate(){
	//var labels = ["Cotizadas y ganadas", "Perdidas y negociando"];
	//var quotation_labels = ["Cotizadas", "Negociando", "Ganadas", "Perdidas"];

	const labels = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio"];
	const data = {
		labels: labels,
		datasets: [{
			label: 'Cotizaciones por mes',
			data: [65, 59, 80, 81, 56, 55, 40],
			backgroundColor: [
			'rgba(255, 99, 132, 0.2)',
			'rgba(255, 159, 64, 0.2)',
			'rgba(255, 205, 86, 0.2)',
			'rgba(75, 192, 192, 0.2)',
			'rgba(54, 162, 235, 0.2)',
			'rgba(153, 102, 255, 0.2)',
			'rgba(201, 203, 207, 0.2)'
			],
			borderColor: [
			'rgb(255, 99, 132)',
			'rgb(255, 159, 64)',
			'rgb(255, 205, 86)',
			'rgb(75, 192, 192)',
			'rgb(54, 162, 235)',
			'rgb(153, 102, 255)',
			'rgb(201, 203, 207)'
			],
			borderWidth: 1
		}]
	};
	var general_quotations_status = new Chart(
		document.getElementById("general-quotations-status-graph").getContext("2d"), {
			type: 'bar',
			data: data,
			options: {
				scales: {
				y: {
					beginAtZero: true
				}
				}
			},
		}
	);
	$("#gqs-loader").hide();

	// $.ajax({
	// 	method : "GET",
	// 	url : getGralHR,
	// 	success : function( response ){
	// 		if( response.status ){
	// 			var status = response.data;
	// 			var qg_np = [ status[0] + status[2], status[1] + status[3] ];
	// 			var total = status[0] + status[1] + status[2] + status[3];
	// 			var general_quotations_status = new Chart(
	// 				document.getElementById("general-hitrate-graph").getContext("2d"), {
	// 			    	type: 'doughnut',
	// 				    data: {
	// 				    	datasets : [{
	// 					        data: qg_np,
	// 					        backgroundColor	: [
	// 					        	'#098e2b',
	// 					        	'#e53935',
	// 					        ],
	// 					        borderColor : [
	// 					        	'#098e2b',
	// 					        	'#e53935',
	// 					        ],
	// 				            borderWidth: 1
	// 					    }],
	// 				    	labels : labels
	// 				    },
	// 				    options : {
	// 				    	tooltips : {
	// 				    		callbacks : {
	// 					    		label : function( tooltips ){
	// 					    			var percentage = (status[tooltips.index] * 100 / total)
	// 									percentage = percentage.toString();
	// 									percentage = percentage.slice( 0, (percentage.indexOf(".")) + 3 );
	// 									percentage = percentage + "%";
	// 									var quotations = "Cotizaciones: " + status[ tooltips.index ];
	// 					    			return new Array( quotations, percentage );
	// 					    		}
	// 				    		}
	// 				    	}
	// 				    }
	// 			});
	// 			$("#ghr-loader").hide();
	// 			var general_quotations_status = new Chart(
	// 			document.getElementById("general-quotations-status-graph").getContext("2d"), {
	// 		    	type: 'doughnut',
	// 			    data: {
	// 			    	datasets : [{
	// 				        data: status, 
	// 				        backgroundColor	: [
	// 				        	'#098e2b',
	// 				        	'#f7d943',
	// 				        	'#4fc3f7',
	// 				        	'#e53935'
	// 				        ],
	// 				        borderColor : [
	// 				        	'#098e2b',
	// 				        	'#f7d943',
	// 				        	'#4fc3f7',
	// 				        	'#e53935'
	// 				        ],
	// 			            borderWidth: 1
	// 				    }],
	// 			    	labels : quotation_labels
	// 			    }
	// 			});
	// 			$("#gqs-loader").hide();
	// 		}
	// 		initMansoi();
	// 	}
	// });
}
function KPIStatements(){
	$("#statements-table").dataTable({
		"columnDefs": [
        	{"className": "dt-center", "targets": "_all"}
      	],
		language : lang_ES_EN,
		columns: [
            { title: "Doc." },
            { title: "Contabilizado" },
            { title: "Se vence" },
            { title: "Total" },
            { title: "Saldo" },
            { title: "Abono futuro" },
            { title: "0-45" }
        ]
	});
	$("#statements-table-loader").hide();
	//updateStatement();
	//initMansoi();
}
function updateStatement(){
	if($("select#partner option:selected").val() != "-1"){
		var height = Math.round($("#statements-table_wrapper").height());
		var width = Math.round($("#statements-table_wrapper").width());
		var image = $("#statements-table-loader");
		image.height( height );
		image.width( height );
		var left;
		image.css("right", Math.round((width-height)/2));
		image.show()
		$.ajax({
			method : "GET",
			url : route + "/reportes/estado-cuenta/getStatement",
			data : {
				"idSocio" : $("select#partner option:selected").val()
			},
			success : function( documentos ){
				var table = $("#statements-table").DataTable();
				table.clear();
				for( var i = 0 ; i < documentos.length ; i++ ){
					var data = new Array();
					var fechaVencimiento = documentos[ i ].fechavencimiento.toString().substring(0, 10);
					var fechaContabilización = documentos[ i ].fechadocumento.toString().substring(0, 10);
					var total = documentos[ i ].TotaldocMN;
					var saldo = documentos[ i ].SaldodocMN;
					data.push( documentos[ i ].Documento );
					data.push( fechaContabilización );
					data.push( fechaVencimiento );
					data.push( "$" + total.toString().slice( 0, (total.indexOf(".")) + 3 ) );
					data.push( "$" + saldo.toString().slice( 0, (saldo.indexOf(".")) + 3 ) );

					var vencimiento = new Date(documentos[ i ].fechavencimiento);
					var hoy = new Date();
					var diff = Math.round( ( hoy - vencimiento ) / ( 1000*60*60*24 ) );
					if( diff < 0 ){
						data.push( "$" + saldo.toString().slice( 0, (saldo.indexOf(".")) + 3 ) );
						data.push("---");
					}else{
						data.push("---");
						data.push( "$" + saldo.toString().slice( 0, (saldo.indexOf(".")) + 3 ) );
					}				
					table.row.add( data );
				}
				image.hide();
				table.draw();
				initMansoi();
			}
		});
	}
}
/**
*
* Funciones adicionales, auxiliares para la manipulación de datos.
*
*/
function getStatus( n ){
	switch( n ){
		case 'Q':
			return "Cotizada"
			break;
		case 'N':
			return "Negociando"
			break;
		case 'G':
			return "Ganada"
			break;
		case 'P':
			return "Perdida"
			break;
		default:
			return "Cotizada"
			break;
	}

}
function shortify( str, n ){
	return str.length >= n ? (str.substr(0, n)) + "..." : str;
}
function shortifyArray( array, n ){
	var aux_array = new Array();
	for( var i = 0 ; i < array.length ; i++ ){		
		aux_array.push( array[ i ].length >= n ? (array[ i ].substr(0, n)) + "..." : array[ i ]);
	}
	return aux_array;
}
function replaceProductsData(chart, label, data ){
	chart.data.datasets[0].data = data ;
	chart.data.datasets[0].label = 'Productos más vendidos de ' + $("select#salesperson option:selected").text();
	chart.options.tooltips.callbacks.title = function(tooltipItems, data) {
                		return label[tooltipItems[0].index];
            		};
	chart.data.labels = shortifyArray(label, 10);
	chart.options.tooltips.callbacks.label = function(tooltipItems){
            			return "Cantidad: " + data[ tooltipItems.index ] ;
            		};
    chart.update();	
}
function replaceQuotationData(chart, label, data, info ) {
	chart.options.onClick = function(event){
		    		var index = quotations_salesperson_chart.getElementAtEvent(event)[0]["_index"];
		    		window.open( show_q.replace("XXX", info.id[ index ]), "_blank");
		    	};
	chart.data.datasets[0].data = data;
	chart.data.datasets[0].label = 'Cotizaciones más altas de ' + $("select#salesperson option:selected").text();
	chart.options.tooltips.callbacks.title = function(tooltipItems, data) {
                		return label[tooltipItems[0].index];
            		};
	chart.data.labels = shortifyArray(label, 10);
	chart.options.tooltips.callbacks.label = function(tooltipItems){
            			var monto = "Monto: " + '$' +  data[tooltipItems.index].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " MXN";
  						var id_item = "ID: " + info.id[tooltipItems.index];
  						var estatus_item = "Estatus: " + getStatus(Number(info.estatus[tooltipItems.index]));
            			return new Array( monto, id_item, estatus_item );
            		};
    chart.update();
}
function replaceSPQuotationStatusData(chart, data, status, total ) {
	chart.data.datasets[0].data = data;
	chart.options.tooltips.callbacks.label = function( tooltips ){
			    			var percentage = (status[tooltips.index] * 100 / total);
							percentage = percentage.toString();
							var inc = percentage.indexOf(".") < 0 ? 1 : 0;
							percentage = percentage.slice( 0, (percentage.indexOf(".")) + 3 + inc );
							percentage = percentage + "%";
							var quotations = "Cotizaciones: " + status[ tooltips.index ];
			    			return new Array( quotations, percentage );
			    		};
	chart.update();
}
function replaceSPHitrateData(chart, data ) {
	chart.data.datasets[0].data = data;
	chart.update();
}
function areEmptyKPI(boolean_array){
	var ok = false;
	for( var i = 0 ; i < boolean_array.length ; i++){
		if( boolean_array[ i ] ){	
			ok = true;
			break;
		}
	}
	return ok;
}