$("#emailingreso").change(function(){

  var email= $(this).val();
	$(".alert").remove();
  var datos= new FormData();

  datos.append("validarEmail",email); //datos.append("nombreVariable",variable)

  $.ajax({

    url: "ajax/formulario.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",//no se pone cuando regresa una echo( estring), si mandamos un objeto se tiene querySelector( poner el timo de dato)
    success:function(respuesta){

      if(respuesta){

        $("#email").val("");
        $("#email").parent().after(`
          <div class=" alert alert-warning">
            <b>ERROR:</b>
            El correo electrónico ya existe en la base de datos,  por favor ingrese otro diferente
          </div>
          `);

      }

    }

  });

})
