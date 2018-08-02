<?php

namespace cafeteria\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrdenRequest extends FormRequest
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
            'idMesas'=>'required',
            'Nombre'=>'required|string',
            'Costo'=>'required',
            'Cantidad'=>'required',
            'Orden'=> 'required',
            'idProductos'=> 'required'

        ];
    }
}
