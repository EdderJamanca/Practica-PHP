<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticulosModel extends Model
{
    protected $table='articulos';

    public function categoria(){
      return $this->belongsTo('App\CategoriaModel','id_cat','id_categoria');
    }
}
