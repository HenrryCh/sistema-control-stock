<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Negoci extends Model
{
    protected $table='negocio';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    	'nombre_negocio','telefono','email','direccion','logo',
    ];
    
    
    
    protected $guarded =[

    ];
}
