<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class nuevaHabitacion extends Model
{
	public $timestamps = false;
     protected $primaryKey = 'ID_HABITACION';
     protected $table = 'HABITACION';
     protected $fillable = [
         'ID_TIPO_HABITACION',
         'ID_ESTADO_HABITACION',
	    'DETALLES',
    ];


   public function type(){
       return $this->belongsTo('App\Models\tipoHabitacion','ID_TIPO_HABITACION');
   }

}
