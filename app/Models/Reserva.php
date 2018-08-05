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

     public function customer(){
         return $this->belongsTo('App\Models\Client','ID_CLIENTE');
     }

     public function source(){
        return $this->belongsTo('App\Models\fuenteReserva','ID_FUENTE');
     }

     public function rooms(){
        return $this->hasMany('App\Models\RoomsByReservation','ID_RESERVA');
     }
}
