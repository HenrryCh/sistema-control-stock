<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NegocioFormRequest extends Request
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
                    'nombre_negocio'=>'required|unique:negocio|max:50',
                    'telefono'=>'required|max:20',
                    'email'=>'nullable|email|max:100',
                    'direccion'=>'max:100',
                    'logo'=>'max:1000',
                    
                ];
                break;                
            case 'PATCH':   //edicion
                $rules = [
                    'nombre_negocio'=>'required|unique:negocio,nombre_negocio,'.$this->id.',id|max:50',
                    'telefono'=>'required|max:20',
                    'email'=>'nullable|email|max:100',
                    'direccion'=>'max:100',
                    'logo'=>'max:1000',
                    
                ];
                break;
            case 'DELETE':
            default:
               
        }

        return $rules;



    }
}
