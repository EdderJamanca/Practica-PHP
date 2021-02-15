$(".tableTestimonio").DataTable({

		  "ajax":"Ajax/TablaTestimonioAjax.php",
		  "deferRender": true,
		  "retrieve": true,
		  "processing": true,
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

// $.ajax({
// 	url:"Ajax/TablaTestimonioAjax.php",
// 	success:function(result){
// 		console.log("result", result);

// 	}
// })

/*=============================================
Aprobar o desaprobar Testimonio
=============================================*/
$(document).on("click",".btnAprobar",function(){

	var isTestimonio =$(this).attr("idTestimonio");
	console.log("isTestimonio", isTestimonio);
	var estadoTestimonio=$(this).attr("estadoTestimonio");
	console.log("estadoTestimonio", estadoTestimonio);

	var boton =$(this);

	var datos = new FormData();

	datos.append("isTestimonio",isTestimonio);

	datos.append("estadoTestimonio",estadoTestimonio);

	$.ajax({
		url:"Ajax/TestimonioAjax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		success:function(resultado){

			if(resultado=="ok"){

				if(estadoTestimonio==0){

					$(boton).removeClass('btn-info');
					$(boton).addClass('btn-dark');
					$(boton).html("Aprobar");
					$(boton).attr("estadoTestimonio",1);

				}else {

					$(boton).addClass('btn-info');
					$(boton).removeClass('btn-dark');
					$(boton).html("Aprobado");
					$(boton).attr("estadoTestimonio",0);

				}

			}

		}
	})

})