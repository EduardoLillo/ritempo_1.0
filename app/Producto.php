<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
protected $table='productos';

    protected $primaryKey='id_producto'; 
    

    public $timestamps=false;

    protected $fillable=['nombre','descripcion','marca','id_subcategoria'];
    
    public function imagenes()
    {

    	return $this->belongsToMany('App\Imagen');
    }
    

}
