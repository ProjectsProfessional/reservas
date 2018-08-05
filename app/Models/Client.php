<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	public $timestamps = false;
	protected $primaryKey = 'ID_CLIENTE';
	protected $table = 'CLIENTE';
	protected $fillable = [
	    'CODIGO',
        'ID_PAIS',
	    'NOMBRE1',
	    'NOMBRE2',
	    'APELLIDO1',
	    'APELLIDO2',
	    'TELEFONO',
	    'EMAIL',
	    'TIPO_CLIENTE',
	    'COMENTARIOS',
	    'PATH_SCAN',
	];
}
