<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticulosPost extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
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
            //'archivo' => 'required | mimes:jpeg,jpg,png,gif | max:10000',
            //'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required',
            'lista' => 'required',
            'moneda' => 'required'
        ];
    }
}
