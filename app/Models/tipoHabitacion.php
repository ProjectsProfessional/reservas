<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tipoHabitacion extends Model
{
	public $timestamps = false;
         protected $primaryKey = 'ID_TIPO_HABITACION';
         protected $table = 'TIPO_HABITACION';
         protected $fillable = [
             'DESCRIPCION',
             'PERSONAS',
         ];
}
