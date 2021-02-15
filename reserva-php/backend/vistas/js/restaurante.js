/*=============================================
LIMPIAR FORMULARIOS DE REGISTRO E INGRESO
=============================================*/

$('.modal.formulario').on('hidden.bs.modal', function(){

	 $(this).find('form')[0].reset();

})
// $.ajax({
// 	url:"Ajax/TablaRestauranteAjax.php",
// 	success:function(result){
// 		console.log("result", result);

// 	}
// })

/*==================================
=            DATA TABLE            =
==================================*/
$(".tableRestaurante").DataTable({
	"ajax":"Ajax/TablaRestauranteAjax.php",
    "deferRender":true,
    "retrieve":true,
    "processing":true,
    "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "",
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
/*============================================
=            SUBIR IMAGE TEMPORAL            =
============================================*/


$("input[name='subirImgRestaurante'], input[name='editarsubirImgRestaurante']").change(function(){

	var image = this.files[0];
	/*============================================
	=VALIDAR EL FORMATO DE LA IMAGEN            =
	============================================*/	

	if(image["type"] != "image/jpeg" && image["type"] != "image/png"){

		$("input[name='subirImgRestaurante'], input[name='editarsubirImgRestaurante']").val("");

		swal({
          title: "Error al subir la imagen",
          text: "¡La imagen debe estar en formato JPG o PNG!",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });

	}else  if(image["size"] > 2000000){

		$("input[name='subirImgRestaurante'], input[name='editarsubirImgRestaurante']").val("");

		swal({
          title: "Error al subir la imagen",
          text: "¡La imagen no debe pesar más de 2MB!",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });

	}else {

		var datosI= new FileReader;
		datosI.readAsDataURL(image);

		$(datosI).on("load",function(event){

			var rutaImage=event.target.result;

			$(".previsualizarImgRestaurante").attr("src",rutaImage);
		})
	}

})
/*============================================
=            SUBIR IMAGE TEMPORAL            =
============================================*/


$("input[name='editarsubirImgRestaurante']").change(function(){

	var image = this.files[0];
	/*============================================
	=VALIDAR EL FORMATO DE LA IMAGEN            =
	============================================*/	

	if(image["type"] != "image/jpeg" && image["type"] != "image/png"){

		$("input[name='editarsubirImgRestaurante']").val("");

		swal({
          title: "Error al subir la imagen",
          text: "¡La imagen debe estar en formato JPG o PNG!",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });

	}else  if(image["size"] > 2000000){

		$("input[name='editarsubirImgRestaurante']").val("");

		swal({
          title: "Error al subir la imagen",
          text: "¡La imagen no debe pesar más de 2MB!",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });

	}else {

		var datosI= new FileReader;
		datosI.readAsDataURL(image);

		$(datosI).on("load",function(event){

			var rutaImage=event.target.result;

			$(".EdiprevisualizarImgRestaurante").attr("src",rutaImage);
		})
	}

})
/*============================================
=            EDITAR RESTAURANTE          =
============================================*/

$(document).on("click",".editarR",function(){

	var idEditar=$(this).attr("idRestaurante");
	console.log("idEditar", idEditar);

	var datos= new FormData();

	datos.append("idEditar",idEditar);

	$.ajax({
		url:"Ajax/RestauranteAjax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(result){
			
			$("input[name='idPlato']").val(result["id_restaurante"]);
			$("input[name='antiguoimgPlato']").val(result["foto"]);
			$(".EdiprevisualizarImgRestaurante").attr("src",result["foto"]);
			$("textarea[name='EditPescripcionRestaurante']").val(result["descripcion"]);

		}
	})
})
/*============================================
=            ELIMINAR RESTAURANTE          =
============================================*/

$(document).on("click",".eliminarR",function(){

	var ideliminar= $(this).attr("idElimin");
	var FotoEliminar= $(this).attr("fotoR");

	swal({
		title: '¿Está seguro de eliminar este plato del Restaurante?',
	    text: "¡Si no lo está puede cancelar la acción!",
	    type: 'warning',
	    showCancelButton: true,
	    confirmButtonColor: '#3085d6',
	    cancelButtonColor: '#d33',
	    cancelButtonText: 'Cancelar',
	    confirmButtonText: 'Si, eliminar plato!'
	}).then(function(result){

		if(result.value){

				var datos = new FormData();
				datos.append("ideliminar",ideliminar);
				datos.append("FotoEliminar",FotoEliminar);

				$.ajax({
					url:"Ajax/RestauranteAjax.php",
					method:"POST",
					data:datos,
					cache:false,
					contentType:false,
					processData:false,
					success:function(respuesta){

					 if(respuesta == "ok"){
			               swal({
			                  type: "success",
			                  title: "¡CORRECTO!",
			                  text: "El Plato del Restaurante ha sido borrado correctamente",
			                  showConfirmButton: true,
			                  confirmButtonText: "Cerrar"
			                 }).then(function(result){

			                    if(result.value){

			                      window.location = "restaurante";

			                    }
			                })

			             }

					}
				})

		}
	})



})
