<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdministradorModel;
use App\BlogModel;
use Illuminate\Support\Facades\Hash;

class AdministradorController extends Controller
{
// MOSTRAR TODOS LOS REGISTROS
    public function index(){
      // $administracion1=AdministradorModel::all();
      // $blog1 = BlogModel::all();
      // return view('paginas.administrador', array('administracion'=>$administracion1,'blog' =>$blog1));

      if(request()->ajax()){

  			  return datatables()->of(AdministradorModel::all())
  			  ->make(true);

  		}

  		$blog = BlogModel::all();
  		$administradores = AdministradorModel::all();

  		return view("paginas.administrador",array("blog"=>$blog, "administradores"=>$administradores));


    }
  // MOSTRAR SOLO UN REGISTRO
    public function show($id){

      $Administradores=AdministradorModel::where("id",$id)->get();

      $blog1 = BlogModel::all();

      $administracion1=AdministradorModel::all();

      if(count($Administradores)!=0){

        return view('paginas.administrador',array('status'=>200,'administracion'=>$administracion1,'blog'=>$blog1,'Administrador'=>$Administradores));

      }else {

        return view('paginas.administrador',array('status'=>400));

      }

    }
    // ACTUALIZAR
    public function update($id, Request $request){

      $datos=array('name' =>$request->input('name'),
                    'email'=>$request->input('email'),
                    'password_actual'=>$request->input('password_actual'),
                    'rol'=>$request->input('rol'),
                    'img-actual'=>$request->input('imagen_actual'));

      $password=array('password'=>$request->input('password'));
      $foto=array('foto'=>$request->file('foto'));


      if (!empty($datos)) {

          $validar=\Validator::make($datos,[
            'name'=>'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
            'email'=>'required|regex:/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/i'
          ]);
          // validar password
          if($password["password"] !=""){

            $validarPassword=\Validator::make($password,[
              "password"=>"required|regex:/^[0-9a-zA-Z]+$/i"
            ]);


            if($validarPassword->fails()){

                return redirect('/administradores')->with("no-validacion","");
            }else {
              $nuevoPasword=Hash::make($password['password']);
            }

          }else {
              $nuevoPasword=$datos['password_actual'];
          }
          // validar foto
          if($foto["foto"] !=""){

            $validarFoto =\Validator::make($foto,[

	                "foto" => "required|image|mimes:jpg,jpeg,png|max:2000000"

	            ]);


            if($validarFoto->fails()){

              return redirect('/administradores')->with("no-validacion","");

            }

          }

          if($validar->fails()){

            return redirect('/administradores')->with("no-validacion","");

          }else {

              if($foto["foto"] !=""){

                if(!empty($datos['img-actual'])){

                    if($datos['img-actual'] !='img/administrador/admin.png'){

                        unlink($datos['img-actual']);

                    }

                }


                $aleatrorio=mt_rand(100,999);

                $ruta ="img/administrador/".$aleatrorio.".".$foto['foto']->guessExtension();

                move_uploaded_file($foto['foto'],$ruta);

              }else {
                $ruta = $datos['img-actual'];
              }
              $dato=array('name' =>$datos['name'],
                           'email'=>$datos['email'],
                            'password'=>$nuevoPasword,
                            'rol'=>$datos['rol'],
                            'foto'=>$ruta);
              $administrador =AdministradorModel::where('id',$id)->update($dato);

              return redirect('/administradores')->with("ok-editar","");


          }

      }else {
        return redirect('/administradores')->with("error","");
      }

    }//fin actualizar


    public function destroy($id,Request $request){

      $validar =AdministradorModel::where('id',$id)->get();


      if (!empty($validar) && $id !=1) {

        if (!empty($validar[0]["foto"])) {

              unlink($validar[0]['foto']);

        }


          $administrador = AdministradorModel::where("id",$validar[0]["id"])->delete();

          // return redirect("/administradores")->with("ok-eliminar","");
          return "ok";
      }else {
        return redirect("/administradores")->with("no-borrar","");
      }

    }
























}//fin clases
