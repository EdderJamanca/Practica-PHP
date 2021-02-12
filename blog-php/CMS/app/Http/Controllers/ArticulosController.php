<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ArticulosModel;
use App\BlogModel;

class ArticulosController extends Controller
{
  public function index(){
    $Articulos=ArticulosModel::all();
    $blog1 = BlogModel::all();
    return view("paginas.articulos",array("articulo1"=>$Articulos,'blog' =>$blog1));
  }
}
