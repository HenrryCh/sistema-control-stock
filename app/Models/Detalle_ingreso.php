<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Detalle_ingreso extends Model
{
    protected $table='detalle_ingresos';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    	'ingreso_id','producto_id','cantidad','precio_compra','subtotal'
    ];
    
    
    public function producto()
    {   
        return $this->belongsTo(Producto::class,'producto_id');
    }
    
    
    protected $guarded =[

    ];
}
