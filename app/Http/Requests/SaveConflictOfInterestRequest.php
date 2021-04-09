<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveConflictOfInterestRequest extends FormRequest {

    public function authorize() {
        return TRUE;
    }

    public function rules() {
        return [
            'client_hash' => 'required',
            'save_and_close' => '',
            'continue' => ''
        ];
    }

    public function messages() {
        return [
            'client_hash.required' => 'Client Hash is required'
        ];
    }

}
