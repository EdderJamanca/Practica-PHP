/*==================================
=            DATA TABLE            =
==================================*/

// $.ajax({
// 	url:"Ajax/TablaBannerAjax.php",
// 	success:function(respuesta){
// 		console.log("respuesta", respuesta);

// 	}
// })

$(".tableBanner").DataTable({
		"ajax":"Ajax/TablaBannerAjax.php",
		"deferRander":true,
		"retrieve":true,
		"processing":true,
		"language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0",
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
});
/*=============================================
=     subir imagen temporal banner            =
===============================================*/

$("input[name='subirBanner'], input[name='editarBanner']").change(function(){

	var imagen =this.files[0];

	/*=============================================
	= VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG=
	===============================================*/

	if(imagen["type"] !="image/jpeg" && imagen["type"] !="image/png"){

		$("input[name='subirBanner'], input[name='editarBanner']").val("");

		swal({
			title: "Error al subir la Imagen",
			text: "¡Ña imagen debe estar en formato JPG o PNG!",
			type: "error",
			confirmButtonText:"¡Cerrar!"
		});

	}else if(imagen["size"]>2000000){

		$("input[name='subirBanner'], input[name='editarBanner']").val("");

		swal({

			type:"error",
			title:"¡Error al subir la imagen!",
			text:"¡La imagen no debe de pesar más de 2MB!",
			confirmButtonText:"¡Cerrar!"
		});

	}else {

		var datosImagen= new FileReader;//objetp para hacer una imagen temporar y visualizar
		datosImagen.readAsDataURL(imagen);

		$(datosImagen).on("load",function(event){
			var rutaImagen = event.target.result;
			$(".previsualizarBanner").attr("src",rutaImagen);
		})

	}

});

/*=============================================
=                  TREAER UN BANNER           =
===============================================*/

$(document).on("click",".editarBanner", function(){

	var idBanner =$(this).attr("idBanner");


	var datos = new FormData();

	datos.append("idBanner",idBanner);

	$.ajax({
		url:"Ajax/BannerAjax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(resultado){

			$('input[name="idBanner"]').val(resultado["id"]);
			$('input[name="bannerActual"]').val(resultado["img"]);
			$('.previsualizarBanner').attr("src",resultado["img"]);

		}
	});
})


/*=============================================
=                  ELIMINAR UN BANNER           =
===============================================*/


$(document).on("click",".eliminarBanner", function(){

	var idElimi =$(this).attr("idBanner");
	var rutaElimi =$(this).attr("rutaBanner");

	swal({
		type:"warning",
		title:"¿Esta seguro de eliminar este banner?",
		text:"¡Si no lo está puede cancelar la acción!",
		showCancelButton:true,
		confirmButtonColor:"#3085d6",
		cancelButtonColor:"#d33",
		cancelButtonText:"Cancelar",
		confirmButtonText: "Si, eliminar Banner"
	}).then(function(result){
		if(result.value){

			var datos = new FormData();
			datos.append("idElimi",idElimi);
			datos.append("rutaElimi",rutaElimi);

			$.ajax({
				url:"Ajax/BannerAjax.php",
				method:"POST",
				data:datos,
				cache:false,
				contentType:false,
				processData:false,
				success:function(resulta){

					if(resulta=="ok"){

						swal({
							type:"success",
							title:"¡CORRECTO!",
							text:"El banner ha sido borrado correctamente",
							showConfirmButton:true,
							confirmButtonText: "Cerrar"
						}).then(function(result){
							window.location="banner";
						})
					}

				}

			})
		}
	})

})


















