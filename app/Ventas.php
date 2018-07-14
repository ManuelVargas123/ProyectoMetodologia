<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table = 'ventas'; // Nombre de la tabla

    public function motores()
    {
    	return $this->hasMany(Motor::class, 'venta_id', 'id');
    }
}
