<?php

namespace Jugueteria\model;

use Illuminate\Database\Eloquent\Model;

class EmpleadoModel extends Model
{	
	protected $primaryKey = "ID";
    protected $table = "Empleado";
    protected $fillable = [
		'IdUsuario',
		'IdEmpresa',
		'Nombre',
		'Apellido',
		'IdTipoDocumento',
		'NumeroDocumento',
		'FechaNacimiento',
		'Estado'
    ];
}


