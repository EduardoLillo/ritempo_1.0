<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    protected $table='subcategorias';

    protected $primaryKey='id_subcategoria'; 
    

    public $timestamps=false;

    protected $fillable=['nombre','descripcion','id_categoria'];

    public function categoria()
    {
    	 return $this-> belongsTo('App\categoria');	
    }
    

    }
