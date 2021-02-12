/*===============================
=            MY PANO            =
===============================*/



$("#360Antiguo").pano({
	img:$("#360Antiguo").attr("back")
});

$(document).on("click","#myPano a",function(e){
	e.preventDefault();
})

/*===============================
=            DATA TABLE          =
===============================*/

// $.ajax({
// 	url:"Ajax/TablaHabitacionAjax.php",
// 	success:function(result){
// 		console.log("result", result);

// 	}
// })

$(".tablaHabitacion").DataTable({
	"ajax":"Ajax/TablaHabitacionAjax.php",
	"deferRender":true,
	"retrieve":true,
	"processing":true,
	"language": {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           " ",
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
ARRASTRAR VARIAS IMAGENES GALERÍA
=============================================*/

var archivosTemporales =[];
// cuando acercamos la imagen al cuadro lo ponemos un fondo
$(".subirGaleria").on("dragenter",function(e){

	e.preventDefault();
	e.stopPropagation();

	$(".subirGaleria").css({"background":"url(vistas/img/plantilla/pattern.jpg)"})

})
// volvemos al fondo de inicio 
$(".subirGaleria").on("dragleave",function(e){

	e.preventDefault();
	e.stopPropagation();

	$(".subirGaleria").css({"background":""})

})
//  AL USAR DRAGOVER SE TIENE Q USAR DROP
$(".subirGaleria").on("dragover",function(e){

	e.preventDefault();
	e.stopPropagation();

})

$(".subirGaleria").on("drop",function(e){

	e.preventDefault();
	e.stopPropagation();

	$(".subirGaleria").css({"backgroung":""});
// capturamos las imagenes
	var archivo =e.originalEvent.dataTransfer.files;

	multiplesArchivos(archivo);

})
$("#galeria").change(function(){

	var archivos =this.files;
	multiplesArchivos(archivos);
})

// VISUALIZAMOS LA IMAGENES CAPTURADAS

function multiplesArchivos(archivo){

	for (var i = 0; i < archivo.length; i++) {
	
			var imagen=archivo[i];

			if(imagen["type"] != "image/jpeg" && imagen["type"] !="image/png"){

				swal({
					type:"error",
					title:"Error al subir la imagen",
					text:"¡La imagen debe estar en formato JPG o PNG!",
					confirmButtonText:"¡Cerrar!"
				})
				return;
			}else if(imagen["size"]>2000000){

				swal({
					type:"error",
					title:"Error al subir la imagen",
					text:"¡La imagen no debe pesar más de 2MB!",
					confirmButtonText:"¡Cerrar!"
				})
				return;

			}else {

				var datosImagen = new FileReader;
				datosImagen.readAsDataURL(imagen);

				$(datosImagen).on("load",function(event){

					var rutaImagen=event.target.result;

					$(".vistaGaleria").append(` 


                      <li class="col-12 col-md-6 col-lg-3 card px-3 rounded-0 shadow-none">

                        <img src="`+rutaImagen+`" class="card-img-top img-fluid" alt="">

                        <div class="card-img-overlay p-0 pr-3">

                            <button class="btn btn-danger btn-sm float-right shadow-sm quitarFotoNueva" temporal="">
                              <i class="fas fa-times"></i>
                            </button>
                          
                        </div>
                        
                      </li>

					`);

					if(archivosTemporales.length !=0){

						archivosTemporales= JSON.parse($(".inputNuevaGaleria").val());
					}
					archivosTemporales.push(rutaImagen);
					$(".inputNuevaGaleria").val(JSON.stringify(archivosTemporales))

				})

			}
	}

}
/*=============================================
QUITAR IMAGEN VIEJA GALERÍA
=============================================*/
$(document).on("click",".quitarFotoNueva",function(){

	var listaFotoNuevos =$(".quitarFotoNueva");


	var listaTemporales=JSON.parse($(".inputNuevaGaleria").val());


	for (var i = 0; i < listaFotoNuevos.length; i++) {
		
		$(listaFotoNuevos[i]).attr("temporal",listaTemporales[i]);

		var quitarImagen=$(this).attr("temporal");

		if(quitarImagen==listaTemporales[i]){

				listaTemporales.splice(i,1);
				$(".inputNuevaGaleria").val(JSON.stringify(listaTemporales));
				$(this).parent().parent().remove();
		}
	}

})

/*=============================================
AGREGAR VIDEO
=============================================*/

$(".agregarVideo").change(function(){

	var codigoVideo=$(this).val();

	$(".vistaVideo").html(` 

		<iframe width="100%" height="320" src="https://www.youtube.com/embed/`+codigoVideo+`" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

		`)

})

/*=============================================
AGREGAR IMAGEN 360
=============================================*/

$("#image360").change(function(){

	var image= this.files[0];
/*=============================================
validar los formatos de la imagen sea jpg o png
=============================================*/
	if(image["type"] !="image/jpeg" && image["type"] !="image/png"){

		swal({
					type:"error",
					title:"Error al subir la imagen",
					text:"¡La imagen debe estar en formato JPG o PNG!",
					confirmButtonText:"¡Cerrar!"
		})
				
		return;

	}else if(image["size"]>2000000){

				swal({
					type:"error",
					title:"Error al subir la imagen",
					text:"¡La imagen no debe pesar más de 2MB!",
					confirmButtonText:"¡Cerrar!"
				})
				return;

	}else {

		var datosImagen= new FileReader;
		datosImagen.readAsDataURL(image);

		$(datosImagen).on("load",function(event){

			var rutaImagen= event.target.result;

			$(".ver360").html(` 

				  <div class="pano" id="360nuevo" back="`+rutaImagen+`">

                       <div class="controls" id="myPano">
                              <a href="#" class="left">&laquo;</a>
                              <a href="#" class="right">&raquo;</a>
                         </div>
                                      
                   </div>

				`);
				$("#360nuevo").pano({
					img:$("#360nuevo").attr("back")
				})

		})

	}


})
/*=============================================
 Plugin CKeditor
=============================================*/

ClassicEditor.create(document.querySelector("#descripcionHabitacion"),{

   toolbar: [ 'heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', '|', 'undo', 'redo']

}).then(function (editor){
	$(".ck-content").css({"height":"400px"})
}).catch(function(error){

})
/*=============================================
QUITAR IMAGEN VIEJA GALERÍA
=============================================*/


$(document).on("click",".quitarFotoAntigua",function(){

	var listaFotoAntigua =$(".quitarFotoAntigua");

	var listaTemporales =$(".inputAntiguaGaleria").val().split(",");
	
	for (var i = 0; i < listaFotoAntigua.length; i++) {

		var quitarlistaImage=$(this).attr("temporal");
		
		if(quitarlistaImage==listaTemporales[i]){

			listaTemporales.splice(i,1);

			$(".inputAntiguaGaleria").val(listaTemporales.toString());

			$(this).parent().parent().remove();

		}
		
	}

})
/*=============================================
GUARDAR HABITACIÓN
=============================================*/

$(".guardarHabitacion").click(function(){

	var idHabitacion =$(".idHabitacion").val();

	var tipo_c =$(".seleccionarTipo").val().split(",")[1];

	var idCategoria =$(".seleccionarTipo").val().split(",")[0];

	var estilo =$(".seleccionarEstilo").val();

	var galeria =$(".inputNuevaGaleria").val();

	var galeriaAntigua=$(".inputAntiguaGaleria").val();


	var video=$(".agregarVideo").val();

	var recorrido_virtual=$("#360nuevo").attr("back");


	var antiguoRecorrido =$(".antiguoRecorrido").val();

	var descripcion = $(".ck-content").html();

	if(tipo_c == "" || idCategoria== ""){

		swal({
			type:"error",
			title:"eror al guardar",
			text:"El campo 'Elija Categoria' no puede ir vacio",
			confirmButtonText:"Cerrar"
		});
		return;

	}else if(estilo==""){
		swal({
			type:"error",
			title:"eror al guardar",
			text:"El campo 'Nombre Habitación' no puede ir vacio",
			confirmButtonText:"Cerrar"
		});
		return;
	}else if(video==""){

		swal({
			type:"error",
			title:"eror al guardar",
			text:"El campo 'Video' no puede ir vacio",
			confirmButtonText:"Cerrar"
		});
		return;

	}else if(descripcion==""){

		swal({
			type:"error",
			title:"eror al guardar",
			text:"El campo 'Descipción' no puede ir vacio",
			confirmButtonText:"Cerrar"
		});
		return;

	}else {

		var datos = new FormData();
		datos.append("idHabitacion",idHabitacion);
		datos.append("tipo_c",tipo_c);
		datos.append("idCategoria",idCategoria);
		datos.append("estilo",estilo);
		datos.append("galeria",galeria);
		datos.append("galeriaAntigua",galeriaAntigua);
		datos.append("video",video);
		datos.append("recorrido_virtual",recorrido_virtual);
		datos.append("antiguoRecorrido",antiguoRecorrido);
		datos.append("descripcion",descripcion);

    	$.ajax({
		    url:"Ajax/HabitacionAjax.php",
		    method: "POST",
		    data: datos,
		    cache: false,
		    contentType: false,
		    processData: false,
		    xhr: function(){
	        
		    	var xhr = $.ajaxSettings.xhr();

		    	xhr.onprogress = function(evt){ 

		    		var porcentaje = Math.floor((evt.loaded/evt.total*100));

		    		$(".preload").before(`

		    			<div class="progress mt-3" style="height:2px">
		    			<div class="progress-bar" style="width: `+porcentaje+`%;"></div>
		    			</div>`
		    			)

		    	};

		    	return xhr;
		          
		    },
	      	success:function(respuesta){

	      		console.log("respuesta", respuesta);

	      		if(respuesta.trim()=="ok"){

	      			swal({
		                type:"success",
		                  title: "¡CORRECTO!",
		                  text: "¡La habitación ha sido guardada exitosamente!",
		                  showConfirmButton: true,
		                confirmButtonText: "Cerrar"
		                
		              }).then(function(result){

		                  if(result.value){

		                    window.location = "Habitaciones";

		                  }

		              });


	      		}


      		}

      	})

	}

})

/*=============================================
Eliminar Habitacion
=============================================*/
$(document).on("click",".eliminarHabitacion",function(){

	var idEliminar=$(this).attr("idEliminar");
	var galeriaHabitacion=$(this).attr("galeriaHabitacion");
	var recorridoHabitacion=$(this).attr("recorridoHabitacion");

	swal({

		type:"warning",
		title:"¡¿Está seguro de eliminar esta habitación?!",
		text:"Si no lo está puede cancelar la acción",
		showCancelButton:true,
		cancelButtonColor:"#d33",
		cancelButtonText:"Cancelar",
		showConfirmButton:true,
		confirmButtonColor:"#3085d6",
		confirmButtonText:"Si, eliminar Habitación"
	}).then(function(result){

		if(result.value){

			var datos = new FormData();
			datos.append("idEliminar",idEliminar);
			datos.append("galeriaHabitacion",galeriaHabitacion);
			datos.append("recorridoHabitacion",recorridoHabitacion);

			$.ajax({
				url:"Ajax/HabitacionAjax.php",
				method:"POST",
				data:datos,
				cache:false,
				contentType:false,
				processData:false,
				success:function(resultado){

					if(resultado.trim()=="ok"){

					swal({
		                type:"success",
		                  title: "¡CORRECTO!",
		                  text: "¡Se ha eliminaro correctamente la habitación!",
		                  showConfirmButton: true,
		                confirmButtonText: "Cerrar"
		                
		              }).then(function(result){

		                  if(result.value){

		                    window.location = "Habitaciones";

		                  }

		              });

					}
				}
			})

		}

	})
})
































