<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AnunciosModel;
use App\BlogModel;

class AnunciosController extends Controller
{
    public function index(){
      $anuncio=AnunciosModel::all();
      $blog1 = BlogModel::all();
      return view("paginas.anuncios",array('anuncios'=>$anuncio,'blog' =>$blog1));
    }
}
