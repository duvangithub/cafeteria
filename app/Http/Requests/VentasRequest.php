<?php

namespace cafeteria\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VentasRequest extends FormRequest
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
            'Nombre'=>'required|string',
            'Costo'=>'required|number',
            'Cantidad'=>'required|number',
            'Orden'=> 'required',
            'idProductos'=> 'required',
            'Total'=>'required|number',
            'Pagado'=>'required|numeric',
            'Estado'=>'required',
            'Tarjeta'=>'required',
        ];
    }
}
