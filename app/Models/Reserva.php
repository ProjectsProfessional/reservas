<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
	public $timestamps = false;
     protected $primaryKey = 'ID_RESERVA';
     protected $table = 'RESERVA';
     protected $fillable = [
        'ID_RESERVA',
        'CODIGO',
 	   'ID_CLIENTE',
 	   'ID_FUENTE',
 	   'ID_ESTADO_RESERVA',
         'PERSONAS',
 	   'FECHA_INGRESO',
 	   'FECHA_RETIRO',
 	   'CODIGO_VUELO',
     ];
}
