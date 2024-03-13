<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Proveedore extends Model
{
    protected $table='proveedores';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    	'nombre','encargado','ruc','telefono','correo','direccion','estado',
    ];
    
    
    
    protected $guarded =[

    ];
}
