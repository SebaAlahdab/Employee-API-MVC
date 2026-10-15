<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
   public function rules()
{
    return [
        'name' => [
            'required',
            'string',
            'max:255',
        ],

        'email' => [
            'required',
            'string',
            'email:rfc',
            'max:255',
            'unique:employees,email',
        ],

        'phone' => [
            'required',
            'string',
            'max:20',
            'regex:/^\+?(?=.*[0-9])[0-9\s().-]+$/',
            'unique:employees,phone',
        ],
    ];
}
}
