<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductosFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        switch ($this->method()) {
            case 'POST':    //Nuevo
                $rules = [
                    'codigo'=>'required|unique:productos|max:20',
                    'nombre'=>'required|max:100',
                    'descripcion'=>'max:255',
                    'marca'=>'max:50',
                    'categoria_id'=>'required',
                    'proveedor_id'=>'',
                    'precio_compra'=>'required',
                    'precio_venta'=>'required',
                    'cantidad'=>'required|numeric|gt:0',
                    'stock_minimo'=>'',
                    'estado'=>'',
                    
                ];
                break;                
            case 'PATCH':   //edicion
                $rules = [
                    'codigo'=>'required|unique:productos,codigo,'.$this->id.',id|max:20',
                    'nombre'=>'required|max:100',
                    'descripcion'=>'max:255',
                    'marca'=>'max:50',
                    'categoria_id'=>'required',
                    'proveedor_id'=>'',
                    'precio_compra'=>'required',
                    'precio_venta'=>'required',
                    'cantidad'=>'required|numeric|gt:0',
                    'stock_minimo'=>'',
                    'estado'=>'',
                    
                ];
                break;
            case 'DELETE':
            default:
               
        }

        return $rules;



    }
}
