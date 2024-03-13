<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    protected $table='salidas';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    	'num_documento','fecha','estado','cliente'
    ];
    
    
    
    protected $guarded =[

    ];
}
