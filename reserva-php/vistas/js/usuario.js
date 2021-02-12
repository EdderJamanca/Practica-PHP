
/*=============================================
LIMPIAR FORMULARIOS DE REGISTRO E INGRESO
=============================================*/
// $(".modal.formulario").on('cuando se habre el modal lo limpiamos',function(){})

 $(".modal.formulario").on('hide.bs.modal', function(){
    	$(this).find('form')[0].reset();
  });

/*=============================================
FORMATEAR LOS IPUNT
=============================================*/
$('input[name="registroEmail"]').change(function(){

	$(".alert").remove();

});

/*=============================================
	VERIFICAR EMAIL EXISTENTE
=============================================*/
$('input[name="registroEmail"]').change(function(){

	var email =$(this).val();
	console.log("email", email);

	var datos= new FormData();

	datos.append("validarEmail",email);

	$.ajax({

		url:rutaOriginal+"ajax/UsuarioAjax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(respuesta){
			console.log("respuesta", respuesta["email_use"]);
			
			if(respuesta){

				var modo =respuesta["modo_use"];

				if(modo=="directo"){

					modo="esta página";
				}
				$('input[name="registroEmail"]').val("");

				$('input[name="registroEmail"]').after(` 

						<div class="alert alert-warning">
							El correo electronico ya existe en la base de daros, fue registrado a traves
							de `+modo+`, por favorpor favor ingrese otro diferente
						</div>
					 `);
				return;

			}

		}
	})

});
/*=============================================
			INGRESO DE FAVEBOOK
=============================================*/
$(".facebook").click(function(){

	FB.login(function(response){

		validarUsuario();

	}, {scope:"public_profile,email"})

})


function validarUsuario(){

	FB.getLoginStatus(function(response){

		statusChangeCallback(response);
	})

}
/*=============================================
VALIDAMOS EL CAMBIO DE ESTADO EN FACEBOOK
=============================================*/

function statusChangeCallback(response){

	if(response.status==='connected'){

		testApi();

	}else {

		swal({
			type: "error",
			title:"¡ERROR!",
			text:"¡Ocurrio un error al ingresar con Facebook, vuelve a intentarlo!",
			showConfirmButton:true,
			confirmButtonText:"Cerrar"
		}).then(function(result){
			if(result.value){
				history.back();
			}
		});

	}

}
/*=============================================
INGRESAMOS A LA API DE FACEBOOK
=============================================*/
function testApi(){

	FB.api('/me?fields=id,name,email,picture',function(response){

		if(response.email==null){

			swal({
				type:"error",
				title:"¡ERROR!",
				text:"¡Para poder ingresar al sistema debe proporcionar la información del correo electronico!",
				showConfirmButton:true,
				confirmButtonText:"Cerrar"
			}).then(function(result){
				if(result.value){
					history.black();
				}
			});
			return;
		}else {

			var email = response.email;

			var nombre = response.name;
			
			var foto= "http://graph.facebook.com/"+response.id+"/picture?type=large";
		
			var datos = new FormData();
			datos.append("email",email);
			datos.append("nombre",nombre);
			datos.append("foto",foto);

			$.ajax({
				url:rutaOriginal+"ajax/UsuarioAjax.php",
				method:"POST",
				data:datos,
				cache:false,
				contentType:false,
				processData:false,
				success:function(respuesta){
					
					if(respuesta=="ok"){

						window.location=rutaOriginal+"perfil";

					}else {

						swal({
							type:"error",
							title:"¡ERROR!",
							text:"¡El correo electrónico!"+email+"ya se registro con un método diferente a Facebook",
							showConfirmButton:true,
							confirmButtonText:"Cerrar"
						}).then(function(result){

							if(result.value){
								FB.getLoginStatus(function(respuesta){

									if(respuesta.status ==='connected'){

										FB.logout(function(respuesta){

											deleteCookie("fblo_244192233781733");

											setTimeout(function(){
												window.location=rutaOriginal+"salir";
											},500)

										});

										function deleteCookie(name){
											document.cookie=name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GNT;';
										}

									}

								})
							}
						})

					}

				}
			})
		}

	});

}
/*=============================================
SALIR DE FACEBOOK
=============================================*/
$(".salir").click(function(e){

	e.preventDefault();

	FB.getLoginStatus(function(response){

		if(response.status==='connected'){

			FB.logout(function(response){

				deleteCookie("fblo_244192233781733");

				setTimeout(function(){
					window.location=rutaOriginal+"salir";
				},500)

			});
			function deleteCookie(name){
				document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
			}

		}else {
			setTimeout(function(){

				window.location=window.location=rutaOriginal+"salir";

			},500)
		}

	})

})