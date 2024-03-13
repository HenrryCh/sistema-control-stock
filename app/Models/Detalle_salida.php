<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Detalle_salida extends Model
{
    protected $table='detalle_salidas';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    	'salida_id','producto_id','cantidad','precio','descuento','subtotal',
    ];
    
    
    public function producto()
    {   
        return $this->belongsTo(Producto::class,'producto_id');
    }
    
    
    protected $guarded =[

    ];
}
