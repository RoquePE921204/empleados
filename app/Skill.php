<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use SoftDeletes;
    protected $fillable  =  ['id'
    						,'empleado_id'
    						,'nombre'
    						,'calificacion'
    ];

    public function empleado()
    {
    	return $this->belongsTo('App\Empleado');
    }
}
