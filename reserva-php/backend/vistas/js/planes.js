
// $.ajax({
// 	"url":"Ajax/TablaPlanesAjax.php",
// 	success:function(respuesta){
// 		console.log("respuesta", respuesta);
// 	}
// })

$(".tablePlanes").DataTable({
	"ajax":"Ajax/TablaPlanesAjax.php",
	"deferRender":true,
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
})

/*=====================================
=            PREVISUALIZAR            =
=====================================*/

$("input[name='subirImgPlan'], input[name='editarImgPlan']").change(function(){

	var image =this.files[0];
	console.log("image", image);

	/*=============================================
	=VALIDAR EL FORMATO DE LA IMAGEN SAE PNG O JPJ
	==============================================*/

	if(image["type"] !="image/jpeg" && image["type"] !="image/png"){

		$("input[name='subirImgPlan'], input[name='editarImgPlan']").val("");

		swal({
			type:"error",
			title:"¡Error al subir la imagen!",
			text:"¡La imagen debe estar en formato JPG o PNG!",
			confirmButtonText:"¡Cerrar!"
		});

	}else if(image["size"]>2000000){

		$("input[name='subirImgPlan'], input[name='editarImgPlan']").val("");

		swal({
			type:"error",
			title:"¡Error al subir la imagen!",
			text:"¡La imagen no debe de pesar más de 2MB!",
			confirmButtonText:"¡Cerrar!"
		});

	}else {

		var datoImagen = new FileReader;
		datoImagen.readAsDataURL(image);

		$(datoImagen).on("load",function(event){

			var rutaImagen =event.target.result;
			$(".previsualizarImgPlan, .EditarprevisualizarImgPlan").attr("src",rutaImagen);

		})

	}



});
/*=================================
=     Plugins   CK EDITOR         =
=================================*/

ClassicEditor.create(document.querySelector('#descripcionPlan'), {

   toolbar: [ 'heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', '|', 'undo', 'redo']

}).then(function (editor) {
  
    $(".ck-content").css({"height":"200px"})

}).catch(function (error) {

	// console.log("error", error);

})


/*=================================
=     Editar  plan         =
=================================*/

$(document).on("click",".editarPlan",function(){

	var idPlan = $(this).attr("idplanes");

	var datos = new FormData();

	datos.append("idPlan",idPlan);

	$.ajax({
		url:"Ajax/PlanesAjax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(resultado){
	
			$("input[name='idPlan']").val(resultado["id_planes"]);
			$("input[name='editarPlan']").val(resultado["tipo"]);
			$("input[name='imgPlanActual']").val(resultado["img"]);
			$(".EditarprevisualizarImgPlan").attr("src",resultado["img"]);
			$("#editarDescriocionPlan").val(resultado["descripcion"]);
			$("input[name='editar_precio_alta']").val(resultado["precio_alto"]);
			$("input[name='editar_precio_baja']").val(resultado["precio_bajo"]);

			ClassicEditor.create(document.querySelector('#editarDescriocionPlan'), {

			   toolbar: [ 'heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', '|', 'undo', 'redo']

			}).then(function (editor) {
			  
			    $(".ck-content").css({"height":"200px"})

			}).catch(function (error) {

				console.log("error", error);

			})

		}

	})


})

/*=================================
=     Eliminar  plan         =
=================================*/

$(document).on("click",".eliminarPlan",function(){

	var idPlanes=$(this).attr("idPlanes");
	var imgPlanes=$(this).attr("imgPlan");

	var datos = new FormData();
	datos.append("idPlanes",idPlanes);
	datos.append("imgPlanes",imgPlanes);

	swal({
		title:"¿Estas segura de eliminar este plan?",
		type:"warning",
		text:"¡Si no lo está puede cancelar la acción!",
		showCancelButton:true,
		confirmButtonColor:"#3085d6",
		cancelButtonColor:"#d33",
		cancelButtonText:"Cancelar",
		confirmButtonText:"Si, eliminar plan"
	}).then(function(result){

		var datos = new FormData();
		datos.append("idEliminar",idPlanes);
		datos.append("imgPlan",imgPlanes);

		$.ajax({
			url:"Ajax/PlanesAjax.php",
			method:"POST",
			data:datos,
			cache:false,
			contentType:false,
			processData:false,
			success:function(result){

				if(result=="ok"){

					swal({
						type:"success",
						title:"¡CORRER!",
						text:"El plan ha sido borrado correctamente",
						showConfirmButton:true,
						confirmButtonText:"Cerrar"
					}).then(function(result){

						if(result.value){
							window.location="planes";
						}

					})
				}

			}
		})

	})

})






