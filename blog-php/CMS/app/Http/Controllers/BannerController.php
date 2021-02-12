<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BannerModel;
use App\BlogModel;

class BannerController extends Controller
{
    public function index(){
      $banner1=BannerModel::all();
      $blog1 = BlogModel::all();
      return view("paginas.banner", array("banner"=>$banner1,'blog' =>$blog1));
    }
}
