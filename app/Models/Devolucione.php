<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Devolucione extends Model
{
    protected $table='devoluciones';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    	'fecha','nombre','telefono','estado',
    ];
    
    
    
    protected $guarded =[

    ];
}
