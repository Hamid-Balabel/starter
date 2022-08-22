<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
            'name_en'=>'required|max:100|unique:offers,name_en',
            'name_ar'=>'required|max:100|unique:offers,name_ar',
            'price'=>'required|numeric',
            'details_en'=>'required',
            'details_ar'=>'required',
        ];

    }
    public function messages()
    {
        return [
            'name_en.required'=>__('messages.offer name required'),
            'name_ar.required'=>__('messages.offer name required'),
            'name_en.unique'=>__('messages.offer name must be unique'),
            'name_ar.unique'=>__('messages.offer name must be unique'),
            'price.numeric'=>__('messages.price must be a number'),
            'price.required'=>__('messages.price required'),
            'details_en.required'=>__('messages.details required'),
            'details_ar.required'=>__('messages.details required'),
        ];
    }
}
