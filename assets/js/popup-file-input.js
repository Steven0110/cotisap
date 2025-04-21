$(document).ready(function(){
	/*
		MINI WIZARD PARA LA SUBIDA DE UNA IMÁGEN
	*/
	$("#add-image-slider").click(function(){
		/*
			INPUT FILE PARA LA IMAGEN [ 1 ]
		*/
		swal({
			title: 'Selecciona una imágen',
			input: 'file',
			confirmButtonText : "Siguiente",
			inputAttributes: {
		    	'accept': 'image/*',
		    	'aria-label': 'Selecciona una imágen'
		  	}
		}).then(function( file ){
			/*
				INPUT TEXT PARA EL TÍTULO DE LA IMÁGEN [ 2 ]
			*/
			swal({
				title : "Título de la imágen",
				input : "text",
				inputValidator: function (value) {
				    return new Promise(function (resolve, reject) {
				      	if ( value ) {
				        	resolve()
				      	} else {
				        	reject('Necesitas escribir algo!')
				      	}
				    })
				},
				confirmButtonText : "Siguiente"
			}).then(function( title ){
				/*
					INPUT TEXT PARA EL LINK DE LA IMAGEN [ 3 ]
				*/
				swal({
					title : "Link",
					input : "text",
					inputValidator: function (value) {
					    return new Promise(function (resolve, reject) {
					      	if ( value ) {
					        	resolve()
					      	} else {
					        	reject('Necesitas escribir algo!')
					      	}
					    })
					},
					confirmButtonText : "Siguiente"
				}).then(function( link ){
					/*IMPRESIÓN DE VARIABLES INGRESADAS*/
					console.log( file );
					console.log( title );
					console.log( link );
					swal({
						title: 'Imágen subida exitosamente',
						type : "success",
						html: $('<div>').addClass('some-class').text(''),
						animation: false,
						customClass: 'animated tada'
					});
				});
			});
		});
	});
});