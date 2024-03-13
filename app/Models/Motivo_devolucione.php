<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Motivo_devolucione extends Model
{
    protected $table='motivo_devoluciones';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    	'nombre','estado',
    ];
    
    
    
    protected $guarded =[

    ];
}
