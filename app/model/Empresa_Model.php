<?php

namespace Jugueteria\model;

use Illuminate\Database\Eloquent\Model;

class Empresa_Model extends Model
{
    protected $primaryKey = "ID";
    protected $table = "empresa";
    protected $fillable = [
		'IdUsuario',
		'Nombre',
		'IdTipoDocumento',
		'NumeroDocumento',
		'Logo',
		'Estado'
    ];
}
