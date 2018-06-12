<?php

namespace Jugueteria\model;

use Illuminate\Database\Eloquent\Model;

class rel_juguete_img extends Model
{
   	protected $primaryKey = "idJugueteImg";
    protected $table = "rel_juguete_img";
    protected $fillable = [
		'IdJuguete',
		'ruta',
		'Imagen',
		'Extension',
		'estado'
    ];
}
