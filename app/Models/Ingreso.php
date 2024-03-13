<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table='ingresos';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    	'fecha','estado','proveedor_id',
    ];
    
    
    public function proveedore()
    {   
        return $this->belongsTo(Proveedore::class,'proveedor_id');
    }
    
    
    protected $guarded =[

    ];
}
