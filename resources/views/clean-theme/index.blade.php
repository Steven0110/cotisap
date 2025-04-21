@extends('clean-theme.body')

@section('custom-styles')
  	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/preloader.css')}}">
  	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery.fancybox.min.css')}}">
  	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
 	<link rel="stylesheet" href="{{ asset('assets/css/sweetalert.css') }}">
	
	<style type="text/css">
		body > #body-container{
	      background-image: url("{{asset('assets/img/black-bg03.jpg')}}") !important;
	      background-size: cover;
	    }
	    .body-nav.body-nav-horizontal{
	      border-bottom: none;
	    }
		input:not([type]):focus:not([readonly]), input[type=text]:not(.browser-default):focus:not([readonly]), input[type=password]:not(.browser-default):focus:not([readonly]), input[type=email]:not(.browser-default):focus:not([readonly]), input[type=url]:not(.browser-default):focus:not([readonly]), input[type=time]:not(.browser-default):focus:not([readonly]), input[type=date]:not(.browser-default):focus:not([readonly]), input[type=datetime]:not(.browser-default):focus:not([readonly]), input[type=datetime-local]:not(.browser-default):focus:not([readonly]), input[type=tel]:not(.browser-default):focus:not([readonly]), input[type=number]:not(.browser-default):focus:not([readonly]), input[type=search]:not(.browser-default):focus:not([readonly]), textarea.materialize-textarea:focus:not([readonly]){
			border-bottom: 1px solid #1f3a4d;
		}
		button.confirm{
			background-color: #1f3a4d !important;
		}
		.sweet-alert{
			-webkit-box-shadow: -3px 14px 51px 5px rgba(31,58,77,1);
			-moz-box-shadow: -3px 14px 51px 5px rgba(31,58,77,1);
			box-shadow: -3px 14px 51px 5px rgba(31,58,77,1);
		}
		.waves-effect.waves-light.btn{
			background-position: 0 -35px !important;
			background-color: #1f3a4d !important;
		}
		.waves-effect.waves-light.btn:hover{
			color: white;
		}
		select{
			display:inline-block !important;
			height: 2rem !important;
		}
		.box .box-header{
			height:50px !important;
		}
		.body-nav.body-nav-horizontal.body-nav-fixed{
			height: 90px !important;
		}
		.body-nav.body-nav-horizontal ul li{
			height: 90px !important;
		}
		.body-nav.body-nav-horizontal ul li a, .body-nav.body-nav-horizontal ul li button {
		  height: 90px !important;
		}
		.page.container{
			padding-top: 40px !important;
		}
		.page.container{
			background-color: rgba(250, 250, 250, 0.5) !important;
			margin-top: 40px !important;
			padding-top: 0 !important;
			padding-left: 20px !important;
			padding-right: 20px !important;
		}
		.box-content{
			background-color: rgba(250, 250, 250, 0.5) !important;
		}
		.edit, .delete{
			cursor: pointer;
		}
		.changer{
			cursor: pointer;
		}
		.animated-modal {
		  max-width: 800px;
		  border-radius: 4px;
		  overflow: hidden;
		  
		  transform: translateY(-50px);
		  transition: all .7s;
		}

		.animated-modal h2,
		.animated-modal p {
		  transform: translateY(-50px);
		  opacity: 0;
		  
		  transition-property: transform, opacity;
		  transition-duration: .4s;
		}

		/* Final state */
		.fancybox-slide--current .animated-modal,
		.fancybox-slide--current .animated-modal h2,
		.fancybox-slide--current .animated-modal p {
		  transform: translateY(0);
		  opacity: 1;
		}

		/* Reveal content with different delays */
		.fancybox-slide--current .animated-modal h2 {
		  transition-delay: .1s;
		}

		.fancybox-slide--current .animated-modal p {
		  transition-delay: .3s;
		}
		.input-field.suffix i {
		  position: absolute;
		  width: 3rem;
		  font-size: 2rem;
		  transition: color .2s;
		  top: 0px;
		  right: 0px;
		}

		.input-field.suffix i.active {
		  color: #26a69a;
		}

		.input-field.suffix input,
		.input-field.suffix textarea {
		  margin-right: 3rem;
		  width: 92%;
		  width: calc(100% - 3rem);
		}

		.input-field.suffix textarea {
		  padding-top: .8rem;
		}

		.input-field.suffix label {
		  margin-right: 3rem;
		}

		@media only screen and (max-width: 992px) {
		  .input-field.suffix input {
		    width: 86%;
		    width: calc(100% - 3rem);
		  }
		}

		@media only screen and (max-width: 600px) {
		  .input-field.suffix input {
		    width: 80%;
		    width: calc(100% - 3rem);
		  }
		}
	</style>
@endsection

@section('content')
    
    @include('clean-theme.menu', ['active' => 'read'])
    <section class="page container">
      
      @include('clean-theme.parts.read-fragment')
      @include('clean-theme.footer')

  	</section>

@endsection

@section('scripts')
	<script type="text/javascript" src="{{asset('assets/js-plugins/preloader.js')}}"></script>
	
	<!--   Core JS Files   -->
    <script src="{{asset('assets/js-plugins/jquery-2.2.4.min.js')}}" type="text/javascript"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
	<script src="{{asset('assets/js-plugins/bootstrap.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/js-plugins/jquery.bootstrap.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/js-plugins/jquery.fancybox.min.js')}}" type="text/javascript"></script>
  	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>

    <script src="{{ asset('assets/js/ajaxSetup.js') }}" type="text/javascript"></script>
  	<script src="{{ asset('assets/js-plugins/sweetalert.min.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
		var companies_data;
		var lang_ES = {"sProcessing":"Procesando...","sLengthMenu":"Mostrar _MENU_ registros","sZeroRecords":"No se encontraron resultados","sEmptyTable":"Ningún dato disponible en esta tabla","sInfo":"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros","sInfoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros","sInfoFiltered":"(filtrado de un total de _MAX_ registros)","sInfoPostFix":"","sSearch":"Buscar:","sUrl":"","sInfoThousands":",","sLoadingRecords":"Cargando...","oPaginate":{"sFirst":"Primero","sLast":"Último","sNext":"Siguiente","sPrevious":"Anterior"},"oAria":{"sSortAscending":": Activar para ordenar la columna de manera ascendente","sSortDescending":": Activar para ordenar la columna de manera descendente"}};
		$(document).ready(function(){
			getCompanies();
			$('.datables-container').on('click', '.select-dropdown li', e => e.preventDefault());
			$(".changer").on("click", togglePassword );
			$("#update-btn").on("click", updateCompany );
		});
		function getCompanies(){
			$.ajax({
				method : "GET",
				url : "{{URL::route('sDashboard')}}/companies/all",
				success : function( response ){
					var TABLE = $("#companies-table").DataTable({
						"columnDefs": [
				        	{"className": "dt-center", "targets": "_all"},
				        	{"targets": 4, "orderable": false},
				        	{"targets": 5, "orderable": false},
				        	{"render" : function(data, type, row){
				        		return "<span id='name-" + row[0] +"'>" + data + "</span>";
				        	}, "targets" : 1 },
				        	{"render" : function(data, type, row){
				        		return "<span id='domain-" + row[0] +"'>" + data + "</span>";
				        	}, "targets" : 3 },
				        	{"render" : function(data, type, row){
				        		return "<img data-fancybox data-src='#update-modal' href='javascript:;' data='" + data + "' class='edit' src='{{asset('assets/img/edit.png')}}' height='30' width='30'/>";
				        	}, "targets" : 4 },
				        	{"render" : function(data, type, row){
				        		return "<img data='" + data + "' class='delete' src='{{asset('assets/img/delete.png')}}' height='30' width='30'/>";
				        	}, "targets" :5 }
				      	],
						language : lang_ES,
						columns : [
		            		{ title: "ID" },
		            		{ title: "Nombre" },
		            		{ title: "Fecha de creación" },
		            		{ title: "Dominio" },
		            		{ title: "Editar" },
		            		{ title: "Eliminar" }
						]
					});
					companies_data = response.data;
					response.data.forEach(function(e){
						var array_aux = new Array();
						array_aux.push(e.id);
						array_aux.push(e.Nombre);
						array_aux.push(e.created_at);
						array_aux.push(e.dominio);
						array_aux.push(e.id);
						array_aux.push(e.id);
						TABLE.row.add( array_aux );
					});
					TABLE.draw();
					$("#table-loader").hide();
					$(".edit").on("click", setCompanyInfo );
					$(".delete").on("click", deleteCompany );
				}
			});
		}
		function togglePassword(e){
			var icon = $(e.currentTarget);
			if( icon.text() == "lock" ){
				icon.siblings("input").attr("type", "text" );
				icon.text("lock_open");
			}else{
				icon.siblings("input").attr("type", "password" );
				icon.text("lock");
			}
		}
		function setCompanyInfo(e){
			var id = $(e.currentTarget).attr("data");
			$.ajax({
				method : "GET",
				url : "{{URL::route('sDashboard')}}/companies/" + id,
				success : function( response ){
					var company = response.data;
					$("#name").val( company.Nombre );
					$("#prefix").val( company.Company );
					$("#url").val( company.logo );
					$("#image").attr("src", company.logo );
					$("#domain").val( company.dominio );
					$("#sap_host").val( company.HOST_Sap );
					$("#sap_dbname").val( company.DB_Sap );
					$("#sap_user").val( company.USER_Sap );
					$("#sap_psw").val( company.PASS_Sap );
					$("#mysql_host").val( company.HOST_cotiSap );
					$("#mysql_dbname").val( company.DB_cotiSap );
					$("#mysql_user").val( company.USER_cotiSap );
					$("#mysql_psw").val( company.PASS_cotiSap );
					$("#container").show();
					$("#loading-container").hide();
				}
			});
		}
		function updateCompany(){
			$("#loading-update").show();
			var id_x = $("#id").val();
			$.ajax({
				method : "POST",
				url : "{{URL::route('sDashboard')}}/companies/" + id_x,
				data : {
					"name" : $("#name").val(),
					"url" : $("#url").val(),
					"domain" : $("#domain").val(),
					"sap_host" : $("#sap_host").val(),
					"sap_dbname" : $("#sap_dbname").val(),
					"sap_user" :  $("#sap_user").val(),
					"sap_psw" : $("#sap_psw").val(),
					"mysql_host" : $("#mysql_host").val(),
					"mysql_dbname" : $("#mysql_dbname").val(),
					"mysql_user" :  $("#mysql_user").val(),
					"mysql_psw" : $("#mysql_psw").val(),
					"_method" : "PUT"
				},
				success : function( response ){
					$("#loading-update").hide();
					if( response.status ){
						swal({
							title : "OK",
							text : "Empresa actualizada correctamente",
							type : "success"
						}, function(){
							$("#name-" + id_x ).text($("#name").val());
							$("#domain-" + id_x ).text($("#domain").val());
							$("#return").click();
						});
					}else{
						swal({
							title : "Error",
							text : "Ocurrió unn error desconocido",
							type : "error"
						});
					}
					console.log( response );
				}
			});
		}
		function deleteCompany(e){
			var id = $(e.currentTarget).attr("data");
			swal({
		        title: "¿Seguro que deseas eliminar a " + $("#name-" + id).text() + "?",
		        text: "No podrás recuperar la información después de esto",
		        type: "warning",
		        showCancelButton: true,
		        confirmButtonColor: '#1f3a4d',
		        confirmButtonText: 'Estoy seguro',
		        cancelButtonText: "Cancelar",
		        closeOnConfirm: false,
		        closeOnCancel: true
		    },
		    function(isConfirm) {
		        if (isConfirm) {
		            swal({
		                title: 'Borrado!',
		                text: 'En realidad no está borrada. Sólo es para testear',
		                type: 'success'
		            });
		        }else{
		            
		        }
		    });
		} 
	</script>

@endsection
