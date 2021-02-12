<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoriaModel;
use App\BlogModel;

class CategoriaController extends Controller
{
      public function index(){
        $categoria=CategoriaModel::all();
        $blog1 = BlogModel::all();
        return view('paginas.categoria',array('categoria' =>$categoria,'blog' =>$blog1));
      }
}
