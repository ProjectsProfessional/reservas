<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class price extends Model
{
	public $timestamps = false;
     protected $primaryKey = 'ID_PRECIO';
     protected $table = 'PRECIO';
     protected $fillable = [
         'ID_MONEDA',
         'ID_IMPUESTO',
	    'BRUTO',
	    'PRECIO',
	    'ID_TIPO_HABITACION'
     ];
}
