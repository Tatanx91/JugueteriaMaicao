<?php

namespace Jugueteria\model;

use Illuminate\Database\Eloquent\Model;

class Juguete_model extends Model
{    
	protected $primaryKey = "IdJuguete";
    protected $table = "juguete";
    protected $fillable = [
		'NumeroReferencia',
		'NombreJuguete',
		'Dimensiones',
		'EdadInicial',
		'EdadFinal',
		'IdGenero',
		'estado'
    ];
}
