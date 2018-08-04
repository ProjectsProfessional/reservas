<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class habitacion_reserva extends Model
{
	public $timestamps = false;
       protected $primaryKey = 'ID_HABITACION_RESERVA';
       protected $table = 'HABITACION_RESERVA';
       protected $fillable = [
           'ID_HABITACION',
           'ID_RESERVA',
           'ID_MONEDA',
		    'PRECIO',
       ];
}
