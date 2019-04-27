<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
	use SoftDeletes;
    protected $fillable  =  ['id'
    						,'nombre'
    						,'email'
    						,'puesto'
    						,'domicilio'
    						,'fecha_nacimiento'
    ];

    public function skills()
    {
    	return $this->hasMany('App\Skill');
    }
}
