<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SalidasFormRequest extends Request
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
                    // 'num_documento'=>'required|max:20',
                    'fecha'=>'required',
                    'cliente'=>'',
                    'estado'=>'required|max:20',
                    
                ];
                break;                
            case 'PATCH':   //edicion
                $rules = [
                    // 'num_documento'=>'required|max:20',
                    'fecha'=>'required',
                    'cliente'=>'',
                    'estado'=>'required|max:20',
                    
                ];
                break;
            case 'DELETE':
            default:
               
        }

        return $rules;



    }
}
