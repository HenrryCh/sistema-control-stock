<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CategoriasFormRequest extends Request
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
                    'nombre'=>'required|unique:categorias|max:100',
                    'estado'=>'',
                    
                ];
                break;                
            case 'PATCH':   //edicion
                $rules = [
                    'nombre'=>'required|unique:categorias,nombre,'.$this->id.',id|max:100',
                    'estado'=>'',
                    
                ];
                break;
            case 'DELETE':
            default:
               
        }

        return $rules;



    }
}
