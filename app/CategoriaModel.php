<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaModel extends Model
{
     protected $table='categorias';

    protected $primaryKey='id_categoria';

    protected $timestamps=false;

    protected $fillable=['nombre'];
    protected $guarded=¨[];
}
