<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtributeRequest extends FormRequest
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
            'name' => 'required|max:50|regex:/^[a-zA-Z0-9\s]+$/',
            'description' => 'max:100|regex:/^[a-zA-Z0-9\s]+$/|nullable',
            'from_date' => 'date',
            'expiry_date' => 'date',
            'price' => 'numeric|nullable',
            'vendor' => 'max:50|regex:/^[a-zA-Z0-9\s]+$/|nullable',
            'other_conditions' => 'max:100|regex:/^[a-zA-Z0-9\s]+$/|nullable',
            'document_name'=>'max:50|regex:/^[a-zA-Z0-9\s]+$/',
            'document'=>'max:1000|file|mimes:xlsx,xls,csv,jpg,jpeg,png,bmp,doc,docx,pdf,tif,tiff'
        ];
    }
}
