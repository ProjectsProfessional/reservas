<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomsByReservation extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'ID_HABITACION_RESERVA';
    protected $table = 'HABITACION_RESERVA';
    protected $fillable = [
        'ID_HABITACION',
        'ID_RESERVA',
        'ID_MONEDA'
    ];

    public function room(){
        return $this->belongsTo('App\Models\nuevaHabitacion','ID_HABITACION');
    }

    public function currency(){
        return $this->belongsTo('App\Models\Currency','ID_MONEDA');
    }
}
