$('#calendar').fullCalendar({
	header: {
    	left: 'prev',
    	center: 'title',
    	right: 'next'
  },
  events: [
    {
      start: '2021-01-12',
      end: '2021-01-15',
      rendering: 'background',
      color: '#847059'
    },
    {
      start: '2021-01-22',
      end: '2021-01-24',
      rendering: 'background',
      color: '#FFCC29'
    }
  ]


});
/*==================================
=            FECHA RESERVA            =
==================================*/
$('.datapicker.entrada').datepicker({
  startDate:'0d',
  datesDisabled:'0d',
  format:'yyyy-mm-dd',
  todayHighlight:true
})

/*==================================
=            DATE TABLE            =
==================================*/

$(".tableReserva").DataTable({
    "ajax":"Ajax/TablaReservasAjax.php",
    "deferRender":true,
    "retrieve":true,
    "processing":true,
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

/*==================================
=            DATE TABLE            =
==================================*/
// $.ajax({
//   url:"Ajax/TablaReservasAjax.php",
//   success:function(resultados){
//     console.log("resultados", resultados);

//   }
// })
/*==================================
=            EDITAR RESERVA            =
==================================*/
$(document).on("click",".editarReserva",function(){

   var idreserva=$(this).attr("idReserva");
   var idusu=$(this).attr("idusu");
   var idHabi=$(this).attr("idHabi");
   var fechasalida=$(this).attr("fechaSal");
   var fechaIngreso=$(this).attr("fechaIng");
   var descripcion=$(this).attr("descripcion");
   console.log("descripcion", descripcion);

   $(".agregarCalendario").html('<idv id="calendar"></idv>');

   // Agregar descripcion al titulo del modal

   $(".modal-title span").html(descripcion);
   // agregar las fechas en el formulario

   $(".entrada").val(fechaIngreso);

   $(".salida").val(fechasalida);

   // ver disponibilidad
   $(".verDisponibilidad").attr("idHabilidad",idHabi);

   $(".guardarNuevaReserva").attr("idReserva",idreserva);

   // Traer las reservas existentes de la habitacion

   var totalEventos=[];
   var datos = new FormData();
   datos.append("idhabitacion",idHabi);

   $.ajax({
      url:"Ajax/ReservaAjax.php",
      method:"POST",
      data:datos,
      cache:false,
      contentType:false,
      processData:false,
      dataType:"json",
      success:function(resultado){

        for (var i = 0; i < resultado.length; i++) {

            // Agregamos las fechas que ya están reservadas de esa habitación

            if(fechaIngreso !=resultado[i]["fecha_ingreso"] ){

                totalEventos.push({
                  "start":resultado[i]["fecha_ingreso"],
                  "end":resultado[i]["fecha_salida"],
                  "rendering":'background',
                  "color":'#847059'
                });
        

            }

        }
        // Agregamos las fechas de la reserva
        totalEventos.push({
              "start":fechaIngreso,
              "end":fechasalida,
              "rendering":'background',
              "color":'#847059'
        })
        /*=============================================
          CALENDARIO
        =============================================*/
        $("#calendar").fullCalendar({
            defaultDate:fechaIngreso,
            header:{
              left:'prev',
              center:'title',
              right:'next'
            },
            events:totalEventos

        });

      }

   })

  /*=============================================
  Agregar la misma cantidad de días para la fecha de salida
  =============================================*/

  var diasReserva=$(this).attr("dias");

  $('.datapicker.entrada').change(function(){

    var fechaEntrada= new Date($(this).val());
    fechaEntrada.setDate(fechaEntrada.getDate()+ Number(diasReserva)+1);

    mes = ("0"+Number(fechaEntrada.getMonth()+1)).slice(-2);
    dia = ("0"+fechaEntrada.getDate()).slice(-2);

    $('.datepicker.salida').val(fechaEntrada.getFullYear()+"-"+mes+"-"+dia);

  })

})
/*=============================================
VER DISPONIBILIDAD NUEVA RESERVA
=============================================*/
$(document).on("click",".verDisponibilidad",function(){

  var fechaImgreso=$(".datapicker.entrada").val();
  var fechaSalida=$(".datepicker.salida").val();
  var idHabitacion =$(this).attr("idHabilidad");

  // Reiniciar Calendario cada vez que busque disponibilidad
   $(".agregarCalendario").html('<idv id="calendar"></idv>');

   var totalEventos=[];
   var opcion1=[];
   var opcion2=[];
   var opcion3=[];
   var validarDisponibilida =false;

   var datos = new FormData();
   datos.append("idhabitacion",idHabitacion);
   $.ajax({

      url:"Ajax/ReservaAjax.php",
      method:"POST",
      data:datos,
      cache:false,
      contentType:false,
      processData:false,
      dataType:"json",
      success:function(resultado){


        for (var i = 0; i < resultado.length; i++) {

              // validar cruce de fechasn opcion 1

              if(fechaImgreso==resultado[i]["fecha_ingreso"]){

                opcion1[i]=false;
              }else {
                opcion1[i]=true;
              }

              console.log("opcion1", opcion1[i]);
              // validar cruce de fechasn opcion 1
              if(fechaImgreso > resultado[i]["fecha_ingreso"] && fechaImgreso < resultado[i]["fecha_salida"]){

                opcion2[i]=false;
              }else {
                opcion2[i]=true;
              }
             // validar cruce de fechasn opcion 3
              if(fechaImgreso < resultado[i]["fecha_ingreso"] && fechaSalida < resultado[i]["fecha_ingreso"]){

                opcion3[i]=false;
              }else {
                opcion3[i]=true;
              }
               // VALIDAR DISPONIBILIDAD


              if(opcion1[i] ==false || opcion2[i] ==false || opcion3[i] ==false){

                validarDisponibilida = false;

              }else{

                validarDisponibilida = true;

              }

            if(!validarDisponibilida){

                  totalEventos.push({
                    "start":resultado[i]["fecha_ingreso"],
                    "end":resultado[i]["fecha_salida"],
                    "rendering":'background',
                    "color":'#847059'
                  });

                  $(".infoDisponibilidad").html(`<h5 class="pb-5 float-left">¡Lo sentimos, no hay disponibilidad para esa fecha!<br><br><strong>¡Vuelve a intentarlo!</strong></h5>`)
                  $(".guardarNuevaReserva").attr("fechaIngreso","");
                  $(".guardarNuevaReserva").attr("fechaSalida","");
                  break;

            }else {

                  totalEventos.push({
                    "start":resultado[i]["fecha_ingreso"],
                    "end":resultado[i]["fecha_salida"],
                    "rendering":'background',
                    "color":'#847059'
                  });

                  $(".infoDisponibilidad").html(`<h5 class="pb-5 float-left">¡Está Disponible!</strong></h5>`)
                  $(".guardarNuevaReserva").attr("fechaIngreso",fechaImgreso);
                  $(".guardarNuevaReserva").attr("fechaSalida",fechaSalida);

            }
          
         }
           //fin for
          if(validarDisponibilida){

                 totalEventos.push({
                    "start":fechaImgreso,
                    "end":fechaSalida,
                    "rendering":'background',
                    "color":'#FFCC29'
                  });

          }

          $("#calendar").fullCalendar({
              defaultDate:fechaImgreso,
              header:{
                left:'prev',
                center:'title',
                right:'next'
              },
              events:totalEventos

          });

      }
   })


})

/*=============================================
Guardar nueva reserva
=============================================*/
$(document).on("click",".guardarNuevaReserva",function(){

  var fechaIngreso =$(this).attr("fechaIngreso");
  var fechaSalida =$(this).attr("fechaSalida");
  var idReserva =$(this).attr("idReserva");

  if(fechaIngreso == "" || fechaSalida==""){

        swal({
            title: "Error al guardar",
            text: "¡No ha seleccionado fechas válidas!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
          });

       return;

  }

  var datos = new FormData();
  datos.append("fechaIngreso",fechaIngreso);
  datos.append("fechaSalida",fechaSalida);
  datos.append("idReserva",idReserva);
    $.ajax({
          url:"Ajax/ReservaAjax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          success:function(result){

            if(result.trim()=="ok"){
                swal({
                  type: "success",
                  title: "¡CORRECTO!",
                  text: "La reserva ha sido modificada correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                }).then(function(result){

                  if(result.value){

                    window.location = "reservas";

                  }
                })
            }

          }
    })

})
/*=============================================
  CANCELAR RECERVA
=============================================*/
$(document).on("click",".eliminarReserva",function(){

    var idReserva =$(this).attr("idReserva");

    swal({
      title: '¿Está seguro de cancelar esta reserva?',
      text: "¡Si no lo está puede cancelar la acción!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, cancelar reserva!'
    }).then(function(result){

        if(result.value){

            var datos = new FormData();
            datos.append("fechaIngreso",null);
            datos.append("fechaSalida",null);
            datos.append("idReserva",idReserva);
              $.ajax({
                    url:"Ajax/ReservaAjax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success:function(result){

                      if(result.trim()=="ok"){
                          swal({
                            type: "success",
                            title: "¡CORRECTO!",
                            text: "La reserva ha sido cancelada correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                          }).then(function(result){

                            if(result.value){

                              window.location = "reservas";

                            }
                          })
                      }

                    }
              })

        }

    })

})