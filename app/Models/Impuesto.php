<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Impuesto extends Model
{
	public $timestamps = false;
     protected $primaryKey = 'ID_IMPUESTO';
     protected $table = 'IMPUESTO';
     protected $fillable = [
         'CODIGO',
         'TASA',
     ];
}
