/*=============================================
LIMPIAR FORMULARIOS DE REGISTRO E INGRESO
=============================================*/

$('.modal.formulario').on('hidden.bs.modal', function(){

	 $(this).find('form')[0].reset();

})

/*====================================
=            COLOR PICKER            =
====================================*/


$(".colorPicker").colorpicker();

/*====================================
=               ICHECK           =
====================================*/
$('input[type="checkbox"]').iCheck({
	checkboxClass:'icheckbox_minimal-blue',
	radioClass:'iradio_minimal-blue'
})


var caracteristicasCategoria =[];
var editarCaracteristicasCategoria=[];
$(".CrearCheckbox").on("ifChecked",function(){

	var item =$(this).val().split(",")[0];
	var icono =$(this).val().split(",")[1];
	caracteristicasCategoria.push({
		"item":item,
		"icono":icono
	})

	$("input[name='caracteristicasCategoria']").val(JSON.stringify(caracteristicasCategoria));

})

$(".EditarCheckbox").on("ifChecked",function(){

	var item =$(this).val().split(",")[0];
	var icono =$(this).val().split(",")[1];

	editarCaracteristicasCategoria.push({
		"item":item,
		"icono":icono
	});
	$("input[name='EditarCaracteristicasCategoria']").val(JSON.stringify(editarCaracteristicasCategoria));

})
$(".CrearCheckbox").on("ifUnchecked",function(){
	
	var item =$(this).val().split(",")[0];
	var icono =$(this).val().split(",")[1];
	for(var i=0; i<caracteristicasCategoria.length; i++){
// crear
		if(caracteristicasCategoria[i]["item"]==item){

			caracteristicasCategoria.splice(i,1);
	       $("input[name='caracteristicasCategoria']").val(JSON.stringify(caracteristicasCategoria));

		}

	}

})

$(".EditarCheckbox").on("ifUnchecked",function(){
	
	var item =$(this).val().split(",")[0];
	var icono =$(this).val().split(",")[1];

	for(var i=0; i<editarCaracteristicasCategoria.length; i++){

		// editar
		if(editarCaracteristicasCategoria[i]["item"]==item){
			editarCaracteristicasCategoria.splice(i,1);
			$("input[name='EditarCaracteristicasCategoria']").val(JSON.stringify(editarCaracteristicasCategoria));
		}

	}


})
/*====================================
=               DATA TABLE          =
====================================*/
// $.ajax({

// 	url:"Ajax/TablaCategoriaAjax.php",
// 	success:function(respuesta){
// 		console.log("respuesta", respuesta);

// 	}

// });


$('.tableCategoria').DataTable({
	"ajax":"Ajax/TablaCategoriaAjax.php",
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
/*=============================================
=            CARGAR IMAGEN  TEMPORAL          =
=============================================*/

$("input[name='subirImgCategoria'], input[name='EditarImgCategoria']").change(function(){
	var image= this.files[0];
	/*=============================================
	=VALIDAR EL FORMATO DE LA IMAGEN SEA JPG o PNG  =
	=============================================*/

	if(image["type"]=="image/jpeg" && image["type"]=="image/png"){

		$("input[name='subirImgCategoria'], input[name='editarRutaActual']").val("");

		swal({
			type:"error",
			title:"¡Error al subir la imagen!",
			text:"¡La imagen debe de estas en formato JPG o PNG!",
			confirmButtonText:"¡Cerrar!"
		});

	}else if(image["size"]>2000000){

		$("input[name='subirImgCategoria'], input[name='editarRutaActual']").val("");

		swal({
			type:"error",
			title:"¡Error al subir la imagen!",
			text:"¡La imagen no debe de pesar más de 2MB!",
			confirmButtonText:"¡Cerrar!"
		});

	}else {

		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(image);

		$(datosImagen).on("load",function(event){

			var rutaImagen=event.target.result;

			$(".previsualizarImgCategoria").attr("src",rutaImagen);
			$(".EditarPrevisualizarImgCategoria").attr("src","");
			$(".EditarPrevisualizarImgCategoria").attr("src",rutaImagen);

		})

	}
})



/*=============================================
=            RUTA CATEGORIA            =
=============================================*/

function limpiarUrl(text){

	var texto= text.toLowerCase();
	texto =texto.replace(/á/g,'a');
	texto =texto.replace(/[é]/g,'e');
	texto =texto.replace(/[í]/g,'i');
	texto =texto.replace(/[ó]/g,'o');
	texto =texto.replace(/[ú]/g,'u');
	texto =texto.replace(/[ñ]/g,'n');
	texto =texto.replace(/ /g,'-');

	return texto;

}
$(document).on("keyup","input[name='rutaCategoria'], input[nam='editarRutaCategoria']",function(){

	$("input[name='rutaCategoria']").val(limpiarUrl($("input[name='rutaCategoria']").val()));
})



/*=============================================
=            TRAER UNA CATEGORIA            =
=============================================*/

$(document).on("click",".editarCategoria",function(){

	$idCategoria=$(this).attr("idCategoria");

	var datos =new FormData();

	datos.append("idCategoria",$idCategoria);

	$.ajax({
		url:"Ajax/CategoriaAjax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(result){
			 console.log("result", result["color"]);

			$("input[name='editarid']").val(result["id"]);
			$("input[name='editarRutaCategoria']").val(result["ruta"]);
			$("input[name='editarColorCategoria']").val(result["color"]);
			$("input[name='editarTipoCategoria']").val(result["tipo_c"]);
			$(".EditarPrevisualizarImgCategoria").attr("src",result["img"]);
			$("input[name='editarRutaActual']").val(result["img"]);
			$("textarea[name='EditarDescripcionCategoria']").val(result["descripcion"]);
			$("input[name='EditarContinental_alta']").val(result["continental_alta"]);
			$("input[name='EditarContinental_baja']").val(result["continental_baja"]);
			$("input[name='EditarAmericano_alta']").val(result["americano_alta"]);
			$("input[name='EditarAmericano_baja']").val(result["americano_baja"]);

			var editarCheck=$(".EditarCheckbox");
			console.log("editarCheck", editarCheck);

			var incluye= JSON.parse(result["incluye"]);

			for (var f = 0; f < editarCheck.length; f++) {

				$(editarCheck[f]).iCheck('uncheck');

				for (var i = 0; i < incluye.length; i++) {

					if(incluye[i]["item"]==$(editarCheck[f]).val().split(",")[0]){

						$(editarCheck[f]).iCheck('check');

					}
					
				}
				
			}


		}

	})


})



/*=============================================
=            ELIMINAR CATEGORIA            =
=============================================*/

$(document).on("click",".eliminarCategoria",function(){

	var idEliminar =$(this).attr("idCartegoria");
	var imgCate =$(this).attr("imgCategoria");
	var tipoCat=$(this).attr("tipoCategoria");

	var datos =  new FormData();

	datos.append("tipo",idEliminar);

	$.ajax({
		url:"Ajax/CategoriaAjax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(result){

			if(result.length !=0){

				swal({
					type:"error",
					title:"Esta categoría no se puede borar",
					text:"¡Tiene habitacion vinculadas!",
					confirmButtonText:"¡Cerrar!"
				});

				return;

			}

		}
	});

	swal({
		title:"¿Está seguro de eliminar esta Categoría?",
		text:"¡Si no está seguro puede cancelar la acción!",
		type:"warning",
		showCancelButton:true,
		confirmButtonColor:'#3085d6',
		cancelButtonColor:'#d33',
		cancelButtonText:"Cancelar",
		confirmButtonText:"Si, eliminar Categoria!"
	}).then(function(result){

		if(result.value){

			var datos = new FormData();

			datos.append("idEliminar",idEliminar);
			datos.append("imgCate",imgCate);
	        datos.append("tipoCat",tipoCat);

	        $.ajax({
	        	url:"Ajax/CategoriaAjax.php",
    			method:"POST",
				data:datos,
				cache:false,
				contentType:false,
				processData:false,
				success:function(result){
					console.log("result", result);
					if(result=="ok"){

						swal({
							type:"success",
							title:"¡CORRECTO!",
							text:"La categoria ha sido borrado correctamente",
							showConfirmButton:true,
							confirmButtonText:"Cerrar"
						}).then(function(result){

							if(result.value){

								window.location="categoria";
							}

						})

					}
				}

	        })
		}

	})

	

})