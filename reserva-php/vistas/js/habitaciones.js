/*=============================================
=           ACTIVAR EL BOTON HABITACION           =
=============================================*/
var rutaOriginal=$("#rutaFromEnd").attr("value");
var servidor =$("#rutaServidor").attr("value");

console.log("servidor", servidor);

var enlacehabitaciones =$(".cabeceraHabitacion ul.nav li.nav-item a");
var tituloBtn=[];

for (var i = 0; i < enlacehabitaciones.length; i++) {
	$(enlacehabitaciones[i]).removeClass("active");
	$(enlacehabitaciones[i]).children("i").remove();
	tituloBtn[i]=$(enlacehabitaciones).html();
}
$(enlacehabitaciones[0]).addClass("active");
$(enlacehabitaciones[0]).html('<i class="fas fa-chevron-right"></i>'+tituloBtn[0]);

$(enlacehabitaciones[enlacehabitaciones.length -1]).css({"border-right":0})// eliminamos el ultimo borde

/*=============================================
=            ENLACE HABITACION           =
=============================================*/


$(".cabeceraHabitacion ul.nav li.nav-item a").click(function(e){
	 e.preventDefault();

	 var orden = $(this).attr("orden");
	 var ruta =$(this).attr("ruta");

	 for (var i = 0; i < enlacehabitaciones.length; i++) {
		$(enlacehabitaciones[i]).removeClass("active");
		$(enlacehabitaciones[i]).children("i").remove();
		tituloBtn[i]=$(enlacehabitaciones[i]).html();
	}
	$(enlacehabitaciones[orden]).addClass("active");
	$(enlacehabitaciones[orden]).html('<i class="fas fa-chevron-right"></i>'+tituloBtn[orden]);

	/*=============================================
	=            		AJAX HABITACION           =
	=============================================*/
	var listaSlide =$(".slideHabitaciones .slide-inner .slide-area li");
	var alturaSlide =$(".slideHabitaciones .slide-inner .slide-area li").height();
	
	for (var i = 0; i < listaSlide.length; i++) {

		$(listaSlide[i]).html("");
		$(listaSlide[i]).css({"height":alturaSlide+"px"});
		
	}


	var datos = new FormData();
	datos.append("ruta",ruta);

	$.ajax({

		url:rutaOriginal+"ajax/habitacionesAjax.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta){
			console.log("respuesta", respuesta);

			var galeria =JSON.parse(respuesta[orden]["galeria"]);
			for (var i = 0; i < galeria.length; i++) {

				$(listaSlide[0]).html('<img class="img-fluid" src="'+servidor+galeria[galeria.length-1]+'">');
				$(listaSlide[i+1]).html('<img class="img-fluid" src="'+servidor+galeria[i]+'">');
				$(listaSlide[galeria.length+1]).html('<img class="img-fluid" src="'+servidor+galeria[0]+'">');
			}



			$(".videoHabitaciones iframe").attr("src","https://www.youtube.com/embed/"+respuesta[orden]["video"]);
			$("#myPano").attr("back",servidor+respuesta[orden]["recorrido_virtual"]);
			$(".descripcionHabitacion h1").html(respuesta[orden]["estilo"]+" "+respuesta[orden]["tipo_c"]);
			$(".d-habitacion").html(respuesta[orden]["descripcion_h"]);

			$('input[name="id-habitacion"]').attr("value",respuesta[orden]["id_h"]);
			 /*=============================================
							360 GRADOS
				=============================================*/

				 $("#myPano").pano({
					img: $("#myPano").attr("back")
				});

			/*=============================================
							TRAER TESTIMONIOS
			=============================================*/

			var datosTestimonios = new FormData();

			datosTestimonios.append("id_h",respuesta[orden]["id_h"]);
			console.log("datosTestimonios", respuesta[orden]["id_h"]);

			$.ajax({
				url:rutaOriginal+"ajax/reservasAjax.php",
				method:"POST",
				data: datosTestimonios,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success:function(respuesta){
				

					var cantidadesTestimonio=0;
					var idTestimonio=[];

					$(".testimonios .row").html("");

					$(".verMasTestimopnio").remove();
					$(".verMenosTestimonio").remove();

					$(".testimonios .row").css({"height":"auto"});

					for (var i = 0; i < respuesta.length; i++) {

						if(respuesta[i]["aprobado"] !=0){

							cantidadesTestimonio++;
							idTestimonio.push(respuesta[i]["id_testimonio"]);

						}
						
					}

					if(cantidadesTestimonio >= 4){

						var foto = [];

						for (var i = 0; i < idTestimonio.length; i++) {

							if(respuesta[i]["foto_use"]== ""){

								foto[i] =servidor+'vistas/img/usuarios/default/default.png';

							}else {

								if(respuesta[i]["modo_use"]== "directo"){

									foto[i] =servidor+respuesta[i]["foto_use"];

								}else{

									foto[i] = respuesta[i]["foto_use"];

								}

							}

							$(".testimonios .row").append(` 

								<div class="col-12 col-lg-3 text-center p-4">

									<img src="`+foto[i]+`" class="img-fluid rounded-circle w-50">

									<h4 class="py-4">`+respuesta[i]["nombre_use"]+`</h4>

									<p>`+respuesta[i]["testimonio"]+`</p>

								</div>

								`);
						     $(".testimonios .row").css({"height":$(".testimonios .row div").height()+58+"px", "overflow":"hidden"});
							
						}
					}else {
						$(".testimonios .row").html('<div class="col-12 text-white text-center">¡Esta habitación aún no tiene testimonios!</div>');
					}
					if(cantidadesTestimonio > 4){

						$(".testimonios .row").after(` 
							<button class="btn btn-default float-right px-4 verMasTestimopnio">VER MÁS</button>
							`);
					}



				}
			});


		}

	})




});

/*=============================================
BLOQUE VER MAS TESTIMONIOS
=============================================*/
var alturaTestimonio =$(".testimonios .row").height();
console.log("alturaTestimonio", alturaTestimonio);
var alturaTestimoniosCorta=$(".testimonios .row div").height()+58;
console.log("alturaTestimoniosCorta", alturaTestimoniosCorta);

$(".testimonios .row").css({"height":alturaTestimoniosCorta+"px", "overflow":"hidden"});

$(document).on("click",".verMasTestimopnio", function(){

	$(".testimonios .row").css({"height":alturaTestimonio+"px", "overflow":"hidden"});
	$(this).removeClass("verMasTestimopnio");
	$(this).addClass("verMenosTestimonio");
	$(this).html("Ver menos");

});

$(document).on("click",".verMenosTestimonio", function(){

	$(".testimonios .row").css({"height":alturaTestimoniosCorta+"px", "overflow":"hidden"});
	$(this).removeClass("verMenosTestimonio");
	$(this).addClass("verMasTestimopnio");
	$(this).html("Ver Más");

});






















