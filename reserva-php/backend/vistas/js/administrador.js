/*===================================
=            DATA TABLES            =
===================================*/

// $.ajax({
// 	url:"Ajax/TablaAdministradorAjax.php",
// 	success: function(respuesta){
// 		console.log("respuesta",respuesta)
// 	}
// });

$(".tableAdministrador").DataTable({
		"ajax":"Ajax/TablaAdministradorAjax.php",
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

/*===================================
=      editar administrador        =
===================================*/

$(document).on("click",".editarAdministrador", function(){

	var idAdministrador = $(this).attr("editarAdministrador");

	var datos = new FormData();
	datos.append("idAdmin",idAdministrador);

	$.ajax({
		url:"Ajax/AdministradorAjax.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType:false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
			
			$('input[name="editarid"]').val(respuesta["id_admin"]);
			$('input[name="editarNombre"]').val(respuesta["nombre"]);
			$('input[name="editarUsuario"]').val(respuesta["usuario"]);
			$('input[name="passwordActual"]').val(respuesta["password"]);
			$('.editarPerfilOpcion').val(respuesta["perfil"]);
			$('.editarPerfilOpcion').html(respuesta["perfil"]);

		}
	});

});
/*=============================================
Activar o desactivar administrador
=============================================*/

$(document).on("click",".btnActivar",function(){

	var idAdmin1 = $(this).attr("idAdmin");
	console.log("idAdmin1", idAdmin1);
	var estadoAdmin =$(this).attr("estadoAdmin");
	var boton =$(this);

	var datos = new FormData();
	datos.append("idAdmin1",idAdmin1);
	datos.append("estadoAdmin",estadoAdmin);

	$.ajax({
		url:"Ajax/AdministradorAjax.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType:false,
		processData:false,
		success:function(respuesta){
			console.log("respuesta", respuesta);

			if(respuesta=="ok"){

				if(estadoAdmin==0){

					$(boton).removeClass('btn-info');
					$(boton).addClass('btn-dark');
					$(boton).html('Desactivado');
					$(boton).attr('estadoAdmin',1);

				}else {

					$(boton).removeClass('btn-dark');
					$(boton).addClass('btn-info');
					$(boton).html('Activado');
					$(boton).attr('estadoAdmin',0);

				}


			}

		}

	})

})


/*=============================================
  eliminar administrador
=============================================*/


$(document).on("click",".eliminarAdministrador", function(){

	var botonidAdm=$(this).attr("eliminarAdministrador");

	if(botonidAdm==1){

		swal({
			type:"error",
			title:"¡ERROR!",
			text:"¡Este Administrador no se puede eliminar!",
			confirmButtonText:"¡Cerrar!"
		});
		return;

	}
	swal({
		type:"warning",
		title:'¿Está seguro de eliminar este administrador?',
		text:"¡Si no lo está puede cancelar la acción!",
		showCanceleButton: true,
		confirmButtonColor: '#3085d6',
		canceleButtonColor: '#d33',
		canceleButtonText: 'Cancelar',
		confirmButtonText:"Si, eliminar Administrador"
		}).then(function(result){

			if(result.value){

					var datos = new FormData();

					datos.append("botonidAdm",botonidAdm);

					$.ajax({

						url:"Ajax/AdministradorAjax.php",
						method:"POST",
						data:datos,
						cache:false,
						contentType:false,
						processData:false,
						success:function(respuesta){
							
							if(respuesta == "ok"){

								swal({
									type:"success",
									title:"¡CORRECTO!",
									text:"El administrador ha sido borrado correctamente",
									showConfirmButton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
								}).then(function(result){

									if(result.value){
										history.back()
									}
								})
							}

						}
					})

			}

		})


})










