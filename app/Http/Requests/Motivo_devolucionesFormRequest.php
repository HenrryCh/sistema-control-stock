<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Motivo_devolucionesFormRequest extends Request
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
                    'nombre'=>'required|max:45',
                    'estado'=>'',
                    
                ];
                break;                
            case 'PATCH':   //edicion
                $rules = [
                    'nombre'=>'required|max:45',
                    'estado'=>'',
                    
                ];
                break;
            case 'DELETE':
            default:
               
        }

        return $rules;



    }
}
