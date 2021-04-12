<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherStoreRequest extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'email' => ['required', 'email', 'unique:users'],
            'mobile' => ['required'],
            'address' => ['required'],
            'suburb' => ['required'],
            'postcode' => ['required'],
            'state' => ['required'],
            'centre' => ['required', 'array'],
            'classes' => ['required', 'array'],
            'permission' => ['required', 'array']
        ];
    }

}
