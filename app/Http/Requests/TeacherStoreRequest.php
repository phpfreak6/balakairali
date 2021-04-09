<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherStoreRequest extends FormRequest
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

            'first_name'    => ['required'],
            'last_name'     => ['required'],
            'password'      => ['required', 'string', 'min:6', 'confirmed'],
            'email'         => ['required','email'],
            'mobile'        => ['required'],
            // 'dob'           => ['required'],
            // 'gender'        => ['required'],
            'address'       => ['required'],
            'suburb'        => ['required'],
            'postcode'      => ['required'],
            'state'         => ['required'],
            'centre'        => ['required', 'array']
            
        ];
    }
}
