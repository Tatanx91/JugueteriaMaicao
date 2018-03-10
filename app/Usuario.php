<?php

namespace Jugueteria;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table='Usuaario';

    protected $primaryKey="idUsuario";

    public $timestamps=false;


    protected $fillable=[
    'IdUsuario',
	'NombreUsuario',
	'ApellidoUsuario',
	'IdTipoDocumento',
	'NumeroDocumento',
	'Contraseña'
    ];

    protected $guarded =[];
}
