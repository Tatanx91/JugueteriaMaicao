<?php

namespace Jugueteria\model;

use Illuminate\Database\Eloquent\Model;

class TipoUsuarioModel extends Model
{
    protected $primaryKey = "ID";
    protected $table = "tipoUsuario";
    protected $fillable = [
		'ID',
		'Nombre'
    ];
}
