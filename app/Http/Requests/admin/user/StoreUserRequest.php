<?php

namespace App\Http\Requests\admin\user;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'phone' => ['required', 'string', 'max:11'],
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
//            'is_vip' => ['required', 'boolean'],
        ];
    }
}
