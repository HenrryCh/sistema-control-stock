<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Detalle_devolucione extends Model
{
    protected $table='detalle_devoluciones';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    	'devolucion_id','producto_id','cantidad','motivo_devolucion_id',
    ];
    
    
    public function motivo_devolucione()
    {   
        return $this->belongsTo(Motivo_devolucione::class,'motivo_devolucion_id');
    }
    
    public function producto()
    {   
        return $this->belongsTo(Producto::class,'producto_id');
    }
    
    
    protected $guarded =[

    ];
}
