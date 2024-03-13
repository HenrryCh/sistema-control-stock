<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DevolucionesFormRequest extends Request
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
                    'fecha'=>'required',
                    'nombre'=>'required|max:100',
                    'telefono'=>'max:20',
                    'estado'=>'',
                    
                ];
                break;                
            case 'PATCH':   //edicion
                $rules = [
                    'fecha'=>'required',
                    'nombre'=>'required|max:100',
                    'telefono'=>'max:20',
                    'estado'=>'',
                    
                ];
                break;
            case 'DELETE':
            default:
               
        }

        return $rules;



    }
}
