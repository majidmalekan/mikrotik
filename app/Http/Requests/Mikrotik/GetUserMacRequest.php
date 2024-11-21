<?php

namespace App\Http\Requests\Mikrotik;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;

class GetUserMacRequest extends FormRequest
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
            'username' => [new RequiredIf(!$this->has('ip_address')), 'string'],
            'ip_address' => [new RequiredIf(!$this->has('username')), 'ip'],
        ];
    }
}
