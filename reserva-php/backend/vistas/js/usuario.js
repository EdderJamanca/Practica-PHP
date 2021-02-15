// $.ajax({
// 	url:"Ajax/TablaUsuarioAjax.php",
// 	success:function(resultado){
// 		console.log("resultado", resultado);

// 	}
// })

$(".tableUsuario").DataTable({
	"ajax":"Ajax/TablaUsuarioAjax.php",
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
});

/*=====================================
=            SUMAR RESERVA 
draw.dt el efecto se hará cuando se pinte la tabla           =
=====================================*/

$(".tableUsuario").on("draw.dt", function(){

	var sumarReserva=$(".sumarReservas");
	console.log(sumarReserva.length);
	var idUsuario =[];
	var sumar=[];

	for (var i = 0; i < sumarReserva.length; i++) {

		idUsuario.push($(sumarReserva).attr("idUsuario"));

		var datos = new FormData();
		datos.append("idUsuarioR",idUsuario[i]);

		$.ajax({
			url:"Ajax/UsuarioAjax.php",
			method:"POST",
			data:datos,
			cache:false,
			contentType:false,
			processData:false,
			dataType:"json",
			success:function(resultado){
				sumar.push(resultado.length);

				for (var f = 0; f < sumar.length; f++) {
					$(sumarReserva[f]).html(sumar[f]);
				}
			}
		})
		
	}

})

/*=====================================
=            SUMAR TESTIMONIO
draw.dt el efecto se hará cuando se pinte la tabla           =
=====================================*/

// $(".tableUsuario").on("draw.dt", function(){

// 	var sumarReserva=$(".sumarTestimonios");
// 	console.log(sumarReserva.length);
// 	var idUsuario =[];
// 	var sumar=[];

// 	for (var i = 0; i < sumarReserva.length; i++) {

// 		idUsuario.push($(sumarReserva).attr("idUsuario"));

// 		var datos = new FormData();
// 		datos.append("idUsuarioT",idUsuario[i]);

// 		$.ajax({
// 			url:"Ajax/UsuarioAjax.php",
// 			method:"POST",
// 			data:datos,
// 			cache:false,
// 			contentType:false,
// 			processData:false,
// 			dataType:"json",
// 			success:function(resultado){
// 				sumar.push(resultado.length);

// 				for (var f = 0; f < sumar.length; f++) {
// 					$(sumarReserva[f]).html(sumar[f]);
// 				}
// 			}
// 		})
		
// 	}

// })
$(".tableUsuario").on("draw.dt", function(){

  var sumarTestimonios = $(".sumarTestimonios");
  var idUsuario = [];
  var sumar = [];

  for(var i = 0; i < sumarTestimonios.length; i++){

    idUsuario.push($(sumarTestimonios[i]).attr("idUsuario"));

    var datos = new FormData();
    datos.append("idUsuarioT", idUsuario[i]);

    $.ajax({

      url:"Ajax/UsuarioAjax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success:function(respuesta){      
      	console.log("respuesta", respuesta);

        sumar.push(respuesta.length);

        for(var f = 0; f < sumar.length; f++){

          $(sumarTestimonios[f]).html(sumar[f]);
        
        }
    
      }

    })

  }

})