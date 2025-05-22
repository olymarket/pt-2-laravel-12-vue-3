<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo'    => [
                'required',
                'min:3',
                'max:80',
                'string'
            ],
            'contenido' => [
                'required',
                'min:3',
                'max:100',
                'string'
            ],
        ];
    }
    public function messages(): array
{
    return [
        'titulo.required'   => 'El título es obligatorio.',
        'titulo.min'        => 'El título debe tener al menos 3 caracteres.',
        'titulo.max'        => 'El título no debe superar los 80 caracteres.',
        'titulo.string'     => 'El título debe ser un texto válido.',

        'contenido.required'=> 'El contenido es obligatorio.',
        'contenido.min'     => 'El contenido debe tener al menos 3 caracteres.',
        'contenido.max'     => 'El contenido no debe superar los 100 caracteres.',
        'contenido.string'  => 'El contenido debe ser un texto válido.',
    ];
}
}
