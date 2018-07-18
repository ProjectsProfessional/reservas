<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'ID_MONEDA';
    protected $table = 'MONEDA';
    protected $fillable = [
        'CODIGO',
        'DESCRIPCION',
    ];
}
