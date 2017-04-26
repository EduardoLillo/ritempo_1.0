<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
	protected $table='imagenes';
	protected $primaryKey='id_imagen'; 
    protected $fillable=['nombre','ruta'];
    public 	  $timestamps=false;
   

	public function productos()
	{
		return $this->belongsToMany('App\Producto');
	}
}
