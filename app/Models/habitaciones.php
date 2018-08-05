<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class habitaciones extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'ID_MEDIA';
    protected $table = 'MEDIA';
    protected $fillable = [
        'ID_HABITACION',
        'PATH',
    ];

}
