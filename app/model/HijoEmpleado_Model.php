<?php

namespace Jugueteria\model;

use Illuminate\Database\Eloquent\Model;

class HijoEmpleado_Model extends Model
{
	protected $primaryKey = "Id";
    protected $table = "Hijoempleado";
    protected $fillable = [
		'IdEmpleado',
		'IdGenero',
		'Nombre',
		'Apellido',
		'IdTipoDocumento',
		'NumeroDocumento',
		'FechaNacimiento',
		'Estado'
    ];}
