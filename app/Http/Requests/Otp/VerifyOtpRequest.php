<?php

namespace App\Http\Requests\Otp;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class VerifyOtpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'otp' => ['integer', 'digits:' . env('OTP_LENGTH'), 'required'],
            'phone' => ['string' , 'required'],
        ];
    }
}
