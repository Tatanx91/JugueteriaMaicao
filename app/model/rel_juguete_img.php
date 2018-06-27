<?php

namespace Jugueteria\model;

use Illuminate\Database\Eloquent\Model;

class rel_juguete_img extends Model
{
   	protected $primaryKey = "ID";
    protected $table = "jugueteimg";
    protected $fillable = [
    	'ID',
		'IdJuguete',
		'ruta',
		'Imagen',
		'Extension',
		'estado'
    ];
}
