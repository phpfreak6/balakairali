<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
//            'password' => ['required', 'string', 'min:6', 'confirmed'],
            // 'email'         => ['required','email'],
            // 'mobile'        => ['required'],
            'dob' => ['required'],
            'gender' => ['required'],
            'address' => ['required'],
            'suburb' => ['required'],
            'postcode' => ['required'],
            'state' => ['required'],
            'p1_type' => ['required'],
            'p1_first_name' => ['required'],
            'p1_last_name' => ['required'],
            'p1_email' => ['required', 'email'],
            'p1_mobile' => ['required'],
            'pin' => ['required', 'digits:4'],
        ];
    }

}
