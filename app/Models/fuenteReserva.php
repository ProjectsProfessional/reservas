<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fuenteReserva extends Model
{
	public $timestamps = false;
	protected $primaryKey = 'ID_FUENTE';
	protected $table = 'FUENTE';
	protected $fillable = [
	    'CODIGO',
	    'DESCRIPCION',
	];
}
