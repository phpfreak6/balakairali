<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateTeacherRequest extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules(Request $request) {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($request->id)],
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
