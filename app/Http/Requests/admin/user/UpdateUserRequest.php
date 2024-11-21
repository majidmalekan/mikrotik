<?php

namespace App\Http\Requests\admin\user;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'phone' => ['sometimes', 'string', 'max:11'],
            'name' => ['sometimes', 'string'],
            'email' => ['sometimes', 'string', 'email'],
//            'is_vip' => ['required', 'boolean'],
        ];
    }
}
