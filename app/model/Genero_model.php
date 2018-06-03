<?php

namespace Jugueteria\model;

use Illuminate\Database\Eloquent\Model;

class Genero_model extends Model
{
    protected $primaryKey = "IdGenero";
    protected $table = "genero";
    protected $fillable = [
		'NombreGenero'
    ];
}
