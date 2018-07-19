<?php

namespace cafeteria\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;



class ProductosRequest extends FormRequest
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
    public function rules()
    {
        return [
            'Descripcion'=>'required|string|max:45',
            'Imagen'=>'required|image',
            'Precio'=>'required|number',
            'Stock'=>'required|numeric',
            'Estado'=>'required',
            'idCategorias'=>'required',
            'Eliminar'=>'required'
        ];
    }
}
