<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProveedoresFormRequest extends Request
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
                    'nombre'=>'required|unique:proveedores|max:100',
                    'encargado'=>'required|max:100',
                    'ruc'=>'required|max:20',
                    'telefono'=>'required|max:20',
                    'correo'=>'required|email|max:100',
                    'direccion'=>'max:100',
                    'estado'=>''
                ];
                break;                
            case 'PATCH':   //edicion
                $rules = [
                    'nombre'=>'required|unique:proveedores,nombre,'.$this->id.',id|max:100',
                    'encargado'=>'required|max:100',
                    'ruc'=>'required|max:20',
                    'telefono'=>'required|max:20',
                    'correo'=>'required|email|max:100',
                    'direccion'=>'max:100',
                    'estado'=>''
                ];
                break;
            case 'DELETE':
            default:
               
        }
        return $rules;
    }
}
