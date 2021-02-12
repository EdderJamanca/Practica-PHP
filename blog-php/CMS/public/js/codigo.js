/*=============================================>>>>>
= Section comment block =
===============================================>>>>>*/
$(document).on("click",".AgregarRed",function(){
  var url=$("#url_red").val();
  var icono=$("#icono_red").val().split(",")[0];
  var color=$("#icono_red").val().split(",")[1];
  $(".listanuevo").append(`
    <div class="col-lg-12">
         <div class="input-group mb-3">

                  <div class="input-group-prepend">

                     <div class="input-group-text" style="background:`+color+`">

                       <i class="text-white `+icono+`"></i>

                     </div>

                  </div>
                  <input type="text" class="form-control" value="`+url+`">

                  <div class="input-group-prepend">

                     <div class="input-group-text" style="cursor:pointer">

                       <span class="bg-danger px-2 rounded-circle eliminarRed" red="`+icono+`" url="`+url+`">&times;</span>

                     </div>

                  </div>

            </div>

    </div>
    `);
    // actualizar las redes de bd

  var listared=JSON.parse($('#listraRed').val());
  listared.push({
    "url":url,
    "icono":icono,
    "background":color
  });
  $('#listraRed').val(JSON.stringify(listared));

})
/*=============================================>>>>>
          ELIMINAR RED
===============================================>>>>>*/
$(document).on("click",".eliminarRed",function(){

  var listaRed=JSON.parse($('#listraRed').val());
  var red=$(this).attr("red");
  var url=$(this).attr("url");
  for (var i = 0; i < listaRed.length; i++) {

    if(red==listaRed[i]["icono"] && url==listaRed[i]["url"] ){

      listaRed.splice(i,1);//splice(indice, cuantos)

      $(this).parent().parent().parent().parent().remove();

      $('#listraRed').val(JSON.stringify(listaRed));

    }
  }

})
/*=============================================>>>>>
                ACTUALIZAR IMAGEN
===============================================>>>>>*/

$("input[type='file']").change(function(){

  var image=this.files[0];
  var tipo=$(this).attr("name");

      if(image["type"] !=="image/png" && image["type"] !=="image/jpeg"){

        $("input[type='file']").val();

        notie.alert({
          type:3,
          text:'¡La imagen debe estar en formato JPG o PNG!',
          time:7
        })

      }else if(image["size"]>2000000){

          $("input[type='file']").val();
          notie.alert({
            type:3,
            text:'¡La imagen no debe pasar más de 2MB!',
            time:7
          })

      }else {

        var datosImagen=new FileReader;

        datosImagen.readAsDataURL(image);

        $(datosImagen).on("load",function(event){

          var rutaImagen =event.target.result;
          $(".previsualizar_"+tipo).attr("src",rutaImagen);

        })


      }

})
/*=============================================>>>>>
      CAPTURAR RUTA
===============================================>>>>>*/
var ruta =$(".ruta").val();
/*=============================================>>>>>
  summernote
===============================================>>>>>*/
$(".summernote_sm").summernote({
  height:300,
  callbacks:{

     onImageUpload: function(files){

       for (var i = 0; i < files.length; i++) {

            upload_sm(files[i]);


       }

     }

  }
});


function upload_sm(file){

  var datos = new FormData();
  datos.append('file',file,file.name);
  datos.append('ruta',ruta);
  $.ajax({
    url:ruta+"/ajax/upload.php",
    method:"POST",
    data:datos,
    contentType:false,
    cache:false,
    processData:false,
    success: function(respuesta){
      $(".summernote_sm").summernote("insertImage",respuesta);//insertamos una imagen
    },
    error:function(jqXHR,textStatus, errorThrown){
      console.error(jqXHR.statusText);
    }

  })

}
$(".summernote_smc").summernote({
  height:300,
  callbacks:{

     onImageUpload: function(files){

       for (var i = 0; i < files.length; i++) {

            upload_smc(files[i]);


       }

     }

  }
});


function upload_smc(file){

  var datos = new FormData();
  datos.append('file',file,file.name);
  datos.append('ruta',ruta);
  $.ajax({
    url:ruta+"/ajax/upload.php",
    method:"POST",
    data:datos,
    contentType:false,
    cache:false,
    processData:false,
    success: function(respuesta){
      $(".summernote_smc").summernote("insertImage",respuesta);//insertamos una imagen
    },
    error:function(jqXHR,textStatus, errorThrown){
      console.error(textStatus+" "+ errorThrown);
    }

  })

}
/*=============================================>>>>>
                ALERTA PARA ELIMINAR
===============================================>>>>>*/
$(document).on("click",".eliminarRegistro",function(){

  var action=$(this).attr("action");
  var method=$(this).attr("method");
  var paginas=$(this).attr("paginas");
  var token = $(this).children("[name='_token']").attr("value");



  swal({
    title:'¿Está seguro de eliminar este registro?',
    text: "¡Si no lo está puede cancelarlo la accion!",
    type:'warning',
    showCancelButton:true,
    confirmButtonColor:'#3085d6',
    cancelButtonColor:'#d33',
    cancelButtonText:'Cancelar',
    confirmButtonText:'Si, eliminar registro!'
  }).then(function(result){

      if(result.value){

        var datos = new FormData();
        datos.append("_method",method);
        datos.append("_token",token);

        $.ajax({
          url:action,
          method:"POST",
          data:datos,
          cache:false,
          contentType:false,
          processData:false,
          success:function(respuesta){

            if(respuesta=="ok"){
              swal({
                type:"success",
                title:"¡El registro ha sido eliminado!",
                showConfirmButtoon:true,
                confirmButtonText:"Cerrar"

              }).then(function(result){

                if(result.value){
                  window.location=ruta+'/'+paginas;
                }

              })

            }

          },
          error: function (jqXHR, textStatus, errorThrown) {
		          console.error(textStatus + " " + errorThrown);
		        }

        })

      }

  })

})
/*=============================================>>>>>
                  DATA TABLE
===============================================>>>>>*/


console.log("ruta", ruta);
$.ajax({

 url: ruta+"/administradores",
 success: function(respuesta){

   console.log("respuesta", respuesta);

 }

})




$('#tablaAdministradores').DataTable({

  // pasamos el lenguaje a español
  "language": {

    "sProcessing": "Procesando...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "Ningún dato disponible en esta tabla",
    "sInfo": "Mostrando registros del _START_ al _END_",
    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix": "",
    "sSearch": "Buscar:",
    "sUrl": "",
    "sInfoThousands": ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
      "sFirst": "Primero",
      "sLast": "Último",
      "sNext": "Siguiente",
      "sPrevious": "Anterior"
    },
    "oAria": {
      "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

  }//fin lenguaje

});
