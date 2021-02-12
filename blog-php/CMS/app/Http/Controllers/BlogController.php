<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogModel;

class BlogController extends Controller
{
    public function index(){
      $blog1 = BlogModel::all();
      return view("paginas.blog", array("blog" => $blog1));
    }
    // ACTUALIZAR
    public function update($id, Request $request){
      // recoger datos
      $datos=array("dominio"=>$request->input('dominio'),
                   "servidor"=>$request->input('servidor'),
                   "titulo"=>$request->input('titulo'),
                   "descripcion"=>$request->input('descripcion'),
                   "palabras_claves"=>$request->input('palabras_claves'),
                    "redes_sociales"=>$request->input('redes_sociales'),
                    "logo_actual"=>$request->input('logo_actual'),
                    "portada_actual"=>$request->input('portada_actual'),
                    "icono_actual"=>$request->input('icono_actual'),
                    "sobre_mi"=>$request->input('sobre_mi'),
                    "sobre_mi_completo"=>$request->input('sobre_mi_completo'));
         // echo '<pre>';print_r($datos); echo'</pre>';

        $logo = array("logo_temporal" =>$request->file("logo"));
        $portada = array("portada_temporal"=>$request->file("portada"));
        $icono= array("icono_temporal"=>$request->file("icono"));

        // validar los datos
       if(!empty($datos)){

         $validar=\Validator::make($datos,[
           "dominio"=>'required|regex:/^[-\\_\\:\\:\\.\\0-9a-z]+$/i',
           "servidor"=>'required|regex:/^[-\\_\\:\\:\\.\\0-9a-z]+$/i',
           "titulo"=>'required|regex:/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
           "descripcion"=>'required|regex:/^[=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
           "palabras_claves"=>'required|regex:/^[,\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
           "redes_sociales"=>'required',
           "sobre_mi"=>'required|regex:/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
           "sobre_mi_completo"=>'required|regex:/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i'
         ]);

         //Validar imagenes logo
         if($logo["logo_temporal"] !=""){

           $validaeLogo=\Validator::make($logo, [
             "logo_temporal"=>'required|image|mimes:jpg,jpeg,png|max:2000000'
           ]);
           if ($validaeLogo->fails()) {
             return redirect("/")->with("no-validacion-imagen","");
           }

         }
         // validar portada
         if($portada["portada_temporal"] !=""){

           $validaePortada=\Validator::make($portada, [
             "portada_temporal"=>'required|image|mimes:jpg,jpeg,png|max:2000000'
           ]);
           if ($validaePortada->fails()) {
             return redirect("/")->with("no-validacion-imagen","");
           }

         }
         // validar icono

         if($icono["icono_temporal"] !=""){

           $validaeIcono=\Validator::make($icono, [
             "icono_temporal"=>'required|image|mimes:jpg,jpeg,png|max:2000000'
           ]);
           if ($validaeIcono->fails()) {
             return redirect("/")->with("no-validacion-imagen","");
           }

         }



       // revisar la validacion
         if($validar->fails()){

           return redirect('/')->with("no-validacion","");

         }else {

          // subir al servidor la imagen logo

          if($logo["logo_temporal"] !=""){

               //unlink($datos["logo_actual"]);//eliminamos el logo logo_temporal

               $aleatorio =mt_rand(100,999);

               $rutaLogo="img/blog/".$aleatorio.".".$logo["logo_temporal"]->guessExtension();
               list($ancho,$alto)=getimagesize($logo["logo_temporal"]);

               $nuevoAncho=700;
               $nuevoAlto=200;

               if($logo["logo_temporal"]->guessExtension()=="jpg"){


                 $origen=imagecreatefromjpeg($logo["logo_temporal"]);

                 $destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);
                 imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
                 imagejpeg($destino,$rutaLogo);
               }

               if($logo["logo_temporal"]->guessExtension()=="png"){

                 $origen=imagecreatefrompng($logo["logo_temporal"]);
                 $destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);
                 imagealphablending($destino,FALSE);
                 imagesavealpha($destino,TRUE);
                 imagecopyresampled($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
                 imagepng($destino,$rutaLogo);
               }

          }else {
            $rutaLogo=$datos["logo_actual"];
            // fin logo
          }
          //subir al SERVIDOR la imagen de la portada
          if($portada["portada_temporal"] !=""){

               //unlink($datos["portada_actual"]);//eliminamos el logo logo_temporal

               $aleatorio =mt_rand(100,999);

               $rutaPortada="img/blog/".$aleatorio.".".$portada["portada_temporal"]->guessExtension();
               list($ancho,$alto)=getimagesize($portada["portada_temporal"]);
               $nuevoAncho=700;
               $nuevoAlto=420;

               if($portada["portada_temporal"]->guessExtension()=="jpg"){

                 $origen=imagecreatefromjpeg($portada["portada_temporal"]);
                 $destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);
                 imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
                 imagejpeg($destino,$rutaLogo);
               }

               if($portada["portada_temporal"]->guessExtension()=="png"){

                 $origen=imagecreatefrompng($portada["portada_temporal"]);
                 $destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);
                 imagealphablending($destino,FALSE);
                 imagesavealpha($destino,TRUE);
                 imagecopyresampled($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
                 imagepng($destino,$rutaPortada);
               }

          }else {
            $rutaPortada=$datos["portada_actual"];

          }//fin subir al servidor portada

          //SUBIR AL SERVIDOR EL ICONO
          if($icono["icono_temporal"] !=""){

               //unlink($datos["icono_actual"]);//eliminamos el logo logo_temporal

               $aleatorio =mt_rand(100,999);

               $rutaIcono="img/blog/".$aleatorio.".".$icono["icono_temporal"]->guessExtension();
               list($ancho,$alto)=getimagesize($icono["icono_temporal"]);
               $nuevoAncho=150;
               $nuevoAlto=150;

               if($icono["icono_temporal"]->guessExtension()=="jpg"){

                 $origen=imagecreatefromjpeg($icono["icono_temporal"]);
                 $destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);
                 imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
                 imagejpeg($destino,$rutaIcono);
               }

               if($icono["icono_temporal"]->guessExtension()=="png"){

                 $origen=imagecreatefrompng($icono["icono_temporal"]);
                 $destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);
                 imagealphablending($destino,FALSE);
                 imagesavealpha($destino,TRUE);
                 imagecopyresampled($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
                 imagepng($destino,$rutaIcono);
               }

          }else {
            $rutaIcono=$datos["icono_actual"];

          }//fin subir al servidor portada

          //Mover todos los ficheros temporales de blog al destino final

          $origen = glob('img/temp/blog/*');//extraemos los ficheros de la carpeta

          foreach ($origen as $fichero) {
            copy($fichero,'img/blog/'.substr($fichero, 14));
            unlink($fichero);
          }
          $blog=BlogModel::all();


           $actualizar =array("dominio" =>$datos["dominio"],
                              "servidor" =>$datos["servidor"],
                              "titulo" =>$datos["titulo"],
                              "descripcion" =>$datos["descripcion"],
                              "palabras_claves"=>json_encode(explode(",",$datos["palabras_claves"])),
                              "redes_sociales"=>$datos["redes_sociales"],
                               "portada"=>$rutaPortada,
                               "logo"=>$rutaLogo,
                               "icono"=>$rutaIcono,
                              "sobre_mi"=>str_replace('src="'.$blog[0]["servidor"].'img/temp/blog','src="'.$blog[0]["servidor"].'img/blog',$datos["sobre_mi"]),
                              "sobre_mi_completo"=>str_replace('src="'.$blog[0]["servidor"].'img/temp/blog','src="'.$blog[0]["servidor"].'img/blog',$datos["sobre_mi_completo"]));
          $blog=BlogModel::where("id",$id)->update($actualizar);
          return redirect('/')->with("actualizado","");

         }

       }else {

           return redirect('/')->with("error","");

       }
       // fin actualizacion
    }

}
