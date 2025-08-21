<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\PhoneHelper;

class LoginRequest extends FormRequest {
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
            'mobile' => 'required|string|regex:/^09\d{9}$/'
        ];
    }
}