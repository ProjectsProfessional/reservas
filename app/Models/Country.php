<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'ID_PAIS';
    protected $table = 'PAIS';
    protected $fillable = [
        'CODIGO',
        'PAIS',
    ];
}
