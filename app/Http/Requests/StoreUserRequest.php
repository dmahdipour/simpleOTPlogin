<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\PhoneHelper;

class StoreUserRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    protected function prepareForValidation(): void
    {
        // قبل از validation، شماره رو نرمال می‌کنیم
        $this->merge([
            'mobile' => PhoneHelper::normalize($this->mobile),
        ]);
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