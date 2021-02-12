/*=============================================
FECHAS RESERVA
=============================================*/
$('.datepicker.entrada').datepicker({
	startDate: '0d',
	format: 'yyyy-mm-dd',
	todayHighlight:true
});

$('.datepicker.entrada').change(function(){

	var fechaEntrada = $(this).val();

	$('.datepicker.salida').datepicker({
		startDate: fechaEntrada,
		datesDisabled: fechaEntrada,
		format: 'yyyy-mm-dd'
	});

})
/*=============================================
    SELECTS ANIDADOS
=============================================*/
$(".selectTipoHabitacion").change(function(){

  var ruta =$(this).val();

  if(ruta !=""){

    $(".selectTemaHabitacion").html("");

  }else {

     $(".selectTemaHabitacion").html('<option>Temática de habitación</option>');

  }

  var datos =new FormData();

  datos.append("ruta",ruta);

  $.ajax({

    url:rutaOriginal+"ajax/HabitacionesAjax.php",
    method:"POST",
    data:datos,
    cache:false,
    contentType:false,
    processData:false,
    dataType:"json",
    success:function(respuesta){

      $("input[name='ruta']").val(respuesta[0]["ruta"]);
      for (var i = 0; i < respuesta.length; i++) {
       $(".selectTemaHabitacion").append('<option value="'+respuesta[i]["id_h"]+'">'+respuesta[i]["estilo"]+'</option>')
      }

    }


  })

})
/*=============================================
    CÓDIGO RESERVA
=============================================*/
var chars="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";

function codigoReserva(chars,length1){

  codigo="";

      for (var i = 0; i < length1; i++) {

        rand=Math.floor(Math.random()*chars.length);

        codigo+=chars.substr(rand,1);
        
      }
      return codigo;

}

/*=============================================
CALENDARIO
=============================================*/
if($(".infoReservas").html() !=undefined){

    var idHabitacion = $(".infoReservas").attr("idHabitacion");

    var fechaIngreso = $(".infoReservas").attr("fechaIngreso");


    var fechaSalida = $(".infoReservas").attr("fechaSalida");

    var dias = $(".infoReservas").attr("dias");


    var opcion1=[];
    var opcion2=[];
    var opcion3=[];
    var validarDisponibilidad = false;
    var totalEvento=[];

    var datos= new FormData();
    datos.append("idHabitacion",idHabitacion);

    $.ajax({

      url:rutaOriginal+"ajax/reservasAjax.php",
      method:"POST",
      data:datos,
      cache:false,
      contentType:false,
      processData:false,
      dataType:"json",
      success:function(respuesta){

            if(respuesta.length==0){

                $('#calendar').fullCalendar({
                  defaultDate:fechaIngreso,
                  header: {
                      left: 'prev',
                      center: 'title',
                      right: 'next'
                  },
                  events: [
                    {
                      start: fechaIngreso,
                      end: fechaSalida,
                      rendering: 'background',
                      color: '#FFCC29'
                    } 
                  ]


                });
              colDerReserva()

            }else {

                // INICIO DEL CICLO
                for (var i = 0; i < respuesta.length; i++) {

                  // VALIDAR CRUCE DE FECHAS OPCION 1
                    if(fechaIngreso==respuesta[i]["fecha_ingreso"]){

                        opcion1[i]=false;

                    }else {

                      opcion1[i]=true;

                    }
                  // VALIDAR CRUCE DE FECHAS OPCION 2
                    if(fechaIngreso > respuesta[i]["fecha_ingreso"] && fechaIngreso < respuesta[i]["fecha_salida"]){

                      opcion2[i]=false;

                    }else {

                      opcion2[i]=true;

                    }
                  //VALIDAR CRUCE DE FECHAS OPCION 3
                    if(fechaIngreso < respuesta[i]["fecha_ingreso"] && fechaSalida > respuesta[i]["fecha_ingreso"]){

                      opcion3[i]=false;

                    }else {

                      opcion3[i]=true;


                    }
                  //VALIDAR DISPONIBILIDAD

                    if(opcion1[i] == false || opcion2[i]==false || opcion3[i]==false){

                        validarDisponibilidad = false;

                    }else {

                        validarDisponibilidad = true;

                    }

                        console.log("validarDisponibilidad", validarDisponibilidad);
                       console.log("opcion1[i]", opcion1[i]);
                       console.log("opcion2[i]", opcion2[i]);
                       console.log("opcion3[i]", opcion3[i]);
                    //DISPONIBILIDAD
                      if(!validarDisponibilidad){

                          totalEvento.push({
                              "start": respuesta[i]["fecha_ingreso"],
                              "end": respuesta[i]["fecha_salida"],
                              "rendering": 'background',
                              "color": '#847059'
                          })

                          $(".infoDisponibilidades").html('<h5 class="pb-5 float-left">¡Lo sentimos, no hay disponibilidad para esa fecha!<br><br><strong>¡Vuelve a intentarlo!</strong></h5>')

                          break;

                      }else {

                          totalEvento.push({
                              "start": respuesta[i]["fecha_ingreso"],
                              "end": respuesta[i]["fecha_salida"],
                              "rendering": 'background',
                              "color": '#847059'
                          })

                          $(".infoDisponibilidades").html('<h1 class="pb-5 float-left">¡Está Disponible!</h1>'); 

                        colDerReserva()

                      }


                  
                }
                // FIN CLICLO FOR

                if(validarDisponibilidad){

                    totalEvento.push({
                              "start": fechaIngreso,
                              "end": fechaSalida,
                              "rendering": 'background',
                              "color": '#FFCC29'
                          })

                }
                $('#calendar').fullCalendar({
                  defaultDate:fechaIngreso,
                    header: {
                        left: 'prev',
                        center: 'title',
                        right: 'next'
                    },
                    events: totalEvento

                });

            }//FIN ELSE IF

      }

    })


}

/*=============================================
FUNCIÓN COL.DERECHA RESERVAS
=============================================*/
function colDerReserva(){

  $(".colDerReservas").show();

  var codigoReserva1 =codigoReserva(chars,9);


  var datos= new FormData();
  datos.append("codigoReserva",codigoReserva1);

  $.ajax({

    url:rutaOriginal+"ajax/reservasAjax.php",
    method:"POST",
    data:datos,
    cache:false,
    contentType:false,
    processData:false,
    dataType:"json",
    success:function(respuesta){



      if(!respuesta){

        $(".codigoReserva").html(codigoReserva1);
        $(".pagarReserva").attr("codigoReserva",codigoReserva1);

      }else {

        $(".codigoReserva").html(codigoReserva1+codigoReserva(chars,3));
        $(".pagarReserva").attr("codigoReserva",codigoReserva1+codigoReserva(chars,3));

      }
      /*=============================================
            CAMBIO DE PLAN 
      =============================================*/
      $(".elegirPlan").change(function(){

        cambioPlanesPersonas();

      })
      /*=============================================
            CAMBIO CANTIDAD DE PERSONAS
      =============================================*/
      $(".cantidadPersonas").change(function(){
        cambioPlanesPersonas();
      })


    }

  })

}


function cambioPlanesPersonas(){

  var personas=$(".cantidadPersonas").val();

  switch(personas){

    case "2":

      $(".precioReserva span").html($(".elegirPlan").val().split(",")[0]*dias);
      $(".precioReserva span").number(true);
      $(".pagarReserva").attr("pagoReserva",$(".elegirPlan").val().split(",")[0]*dias);
      $(".pagarReserva").attr("plan",$(".elegirPlan").val().split(",")[1]);
      $(".pagarReserva").attr("personas",$(".cantidadPersonas").val());

    break;

    case "3":

          $(".precioReserva span").html(Number($(".elegirPlan").val().split(",")[0]*0.25)+ Number($(".elegirPlan").val().split(",")[0]*dias));
          $(".precioReserva span").number(true);
          $(".pagarReserva").attr("pagoReserva",Number($(".elegirPlan").val().split(",")[0]*0.25)+ Number($(".elegirPlan").val().split(",")[0]*dias));
          $(".pagarReserva").attr("plan",$(".elegirPlan").val().split(",")[1]);
          $(".pagarReserva").attr("personas",$(".cantidadPersonas").val());

    break;

    case "4":

          $(".precioReserva span").html(Number($(".elegirPlan").val().split(",")[0]*0.50)+ Number($(".elegirPlan").val().split(",")[0]*dias));
          $(".precioReserva span").number(true);
          $(".pagarReserva").attr("pagoReserva",Number($(".elegirPlan").val().split(",")[0]*0.50)+ Number($(".elegirPlan").val().split(",")[0]*dias));
          $(".pagarReserva").attr("plan",$(".elegirPlan").val().split(",")[1]);
          $(".pagarReserva").attr("personas",$(".cantidadPersonas").val());
    break;

    case "5":

          $(".precioReserva span").html(Number($(".elegirPlan").val().split(",")[0]*0.75)+ Number($(".elegirPlan").val().split(",")[0]*dias));
          $(".precioReserva span").number(true);
          $(".pagarReserva").attr("pagoReserva",Number($(".elegirPlan").val().split(",")[0]*0.75)+ Number($(".elegirPlan").val().split(",")[0]*dias));
          $(".pagarReserva").attr("plan",$(".elegirPlan").val().split(",")[1]);
          $(".pagarReserva").attr("personas",$(".cantidadPersonas").val());
    break;

  }

}
/*=============================================
=      funcion para generar COOKIES           =
=============================================*/
function crearCookie(nombre,valor, diasExpedicion){

  var hoy = new Date();

  hoy.setTime(hoy.getTime() + (diasExpedicion*24*60*60*1000));

  var fechaExpedida="expires="+hoy.toUTCString();

  document.cookie= nombre +"="+ valor +";"+fechaExpedida;

}

/*=============================================
=      CAPTURAR DATOS DE LA RESERVA          =
=============================================*/
$(".pagarReserva").click(function(){

  var idHabitacion=$(this).attr("idHbitacion");
  console.log("idHabitacion", idHabitacion);

  var imgHabitacion=$(this).attr("imgHabitacion");
  console.log("imgHabitacion", imgHabitacion);

  var infoHabitacion=$(this).attr("infoHabitacion")+"-"+$(this).attr("plan")+"-"+$(this).attr("personas");
  console.log("infoHabitacion", infoHabitacion);

  var pagoReserva=$(this).attr("pagoReserva");
  console.log("pagoReserva", pagoReserva);

  var codigoReserva=$(this).attr("codigoReserva");
  console.log("codigoReserva", codigoReserva);

  var fechaIngreso=$(this).attr("fechaIngreso");
  console.log("fechaIngreso", fechaIngreso);

  var fechaSalida=$(this).attr("fechaSalida");
  console.log("fechaSalida", fechaSalida);

  crearCookie("idHabitacion",idHabitacion, 1);
  crearCookie("imgHabitacion",imgHabitacion, 1);
  crearCookie("infoHabitacion",infoHabitacion, 1);
  crearCookie("pagoReserva",pagoReserva, 1);
  crearCookie("codigoReserva",codigoReserva, 1);
  crearCookie("fechaIngreso",fechaIngreso, 1);
  crearCookie("fechaSalida",fechaSalida, 1);


})