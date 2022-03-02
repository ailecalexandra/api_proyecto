<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'start_at'=>'required',
            'end_at'=> 'required'
        ];
    }
    public function messages()
    {
        return [
            'start_at.date'=> 'la fecha de inicio debe ser de tipo date',
            'end_at.date'=> 'la fecha de fin debe ser de tipo date',
            'start_at.before' => 'la fecha de fin debe ser posterior a la de incio',
            'end_at.after' => 'la fecha de inicio debe ser anterior a la de fin'
        ];
    }
}
