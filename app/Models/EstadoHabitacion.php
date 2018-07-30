<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoHabitacion extends Model
{
	public $timestamps = false;
	protected $primaryKey = 'ID_ESTADO_HABITACION';
	protected $table = 'ESTADO_HABITACION';
	protected $fillable = [
	    'DESCRIPCION'
	];
}
