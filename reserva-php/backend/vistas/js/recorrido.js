
// $.ajax({
// 	url:"Ajax/TablaRecorridoAjax.php",
// 	dataType:"json",
// 	success:function(resltado){
// 		console.log("resltado", resltado);

// 	}
// })

$(".tableRecorrido").DataTable({
"ajax":"Ajax/TablaRecorridoAjax.php",
  "deferRender": true,
  "retrieve": true,
  "processing": true,
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
/*=============================================
CARGAR IMAGEN Pequeña
=============================================*/

$("input[name='subirImgPeqRecorrido'], input[name='EditarsubirImgPeqRecorrido']").change(function(){

  var image= this.files[0];
  console.log("image", image);

    if(image["type"] !='image/jpeg' && image["type"] !='image/png'){

      $("input[name='subirImgPeqRecorrido']").val("");

       swal({
          title: "Error al subir la imagen",
          text: "¡La imagen debe estar en formato JPG o PNG!",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });

    }else if(image["size"]==2000000){

      $("input[name='subirImgPeqRecorrido']").val("");

        swal({
          title: "Error al subir la imagen",
          text: "¡La imagen no debe pesar más de 2MB!",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });


    }else {

      var foto = new FileReader();
      foto.readAsDataURL(image);

      $(foto).on("load",function(event){

        var rutaImage=event.target.result;

        $(".previsualizarImgRecorrido").attr("src",rutaImage);
      })

    }

})
/*=============================================
CARGAR IMAGEN GRANDE
=============================================*/

$("input[name='subirImgGraRecorrido'], input[name='EditarSubirImgGraRecorrido']").change(function(){

  var image= this.files[0];
  console.log("image", image);

    if(image["type"] !='image/jpeg' && image["type"] !='image/png'){

      $("input[name='subirImgPeqRecorrido']").val("");

       swal({
          title: "Error al subir la imagen",
          text: "¡La imagen debe estar en formato JPG o PNG!",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });

    }else if(image["size"]==2000000){

      $("input[name='subirImgPeqRecorrido']").val("");

        swal({
          title: "Error al subir la imagen",
          text: "¡La imagen no debe pesar más de 2MB!",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });


    }else {

      var foto = new FileReader();
      foto.readAsDataURL(image);

      $(foto).on("load",function(event){

        var rutaImage=event.target.result;

        $(".previsualizarImgGrandeRecorrido").attr("src",rutaImage);
      })

    }

})
/*=============================================
Editar Recorrido
=============================================*/

$(document).on("click",".editarRecorrido",function(){

  var idRecorrido= $(this).attr("idRecorrido");

  var datos = new FormData();

  datos.append("idRecorrido",idRecorrido);

  $.ajax({
    url:"Ajax/RecorridoAjax.php",
    method:"POST",
    data:datos,
    cache:false,
    contentType:false,
    processData:false,
    dataType:"json",
    success:function(result){
 
      $("input[name='idrecorrido']").val(result[0]["id_recorrido"]);
      $("input[name='editartituloRecorrido']").val(result[0]["titulo"]);
      $("textarea[name='editarDescripcionRecorrido']").val(result[0]["descripcion"]);
      $("input[name='imgPeAntigua']").val(result[0]["foto_peq"]);
      $(".previsualizarImgRecorrido").attr("src",result[0]["foto_peq"]);
      $("input[name='imgGranAntigua']").val(result[0]["foto_gran"]);
      $(".previsualizarImgGrandeRecorrido").attr("src",result[0]["foto_gran"]);

    }
  })

})

/*=============================================
  Eliminar Recorrido
=============================================*/

$(document).on("click",".eliminarRecorrido",function(){

  var idEliminar = $(this).attr("idRecorrido");
  var imgGrande = $(this).attr("imgGrandeRecorrido");
  var imgPeque = $(this).attr("imgPeqRecorrido");

  swal({
        type:"success",
        title:"¿Está seguro de eliminar este recorrido?",
        text:"¡Si no lo está puede cancelar la acción!",
        showCancelButton:true,
        cancelButtonColor:"#3085d6",
        cancelButtonColor:"#d33",
        cancelButtonText:"Cancelar",
        confirmButtonText:"Si, eliminarRecorrido!"
    }).then(function(result){

      if(result.value){

          var datos = new FormData();
          datos.append("idEliminar",idEliminar);
          datos.append("imgGrande",imgGrande);
          datos.append("imgPeque",imgPeque);
          $.ajax({
                url:"Ajax/RecorridoAjax.php",
                method:"POST",
                data:datos,
                cache:false,
                contentType:false,
                processData:false,
                success:function(resultado){

                  if(resultado.trim()=="ok"){

                      swal({
                        type: "success",
                        title: "¡CORRECTO!",
                        text: "El Recorrido ha sido borrado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                       }).then(function(result){

                          if(result.value){

                            window.location = "recorrido";

                          }
                      })

                  }

                }
          })
      }

    })

})