<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'name'          => 'required|string|max:100',
            'family'        => 'required|string|max:100',
            'national_code' => 'required|numeric|digits:10|unique:users,national_code',
            'mobile'        => 'required|string|unique:users,mobile',
            'password'      => 'required|string|min:6'
        ];
    }
}