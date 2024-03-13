<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table='productos';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    	'codigo','nombre','descripcion','marca','categoria_id','proveedor_id','precio_compra','precio_venta','cantidad','stock_minimo','estado',
    ];
    
    
    public function categoria()
    {   
        return $this->belongsTo(Categoria::class,'categoria_id');
    }
    
    public function proveedore()
    {   
        return $this->belongsTo(Proveedore::class,'proveedor_id');
    }
    
    
    protected $guarded =[

    ];
}
