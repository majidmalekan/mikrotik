<?php

namespace App\Http\Requests\admin\user;

use App\Enums\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Enum\Laravel\Rules\EnumRule;

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
            'email' => ['sometimes', 'string', 'email',Rule::unique('users','email')->ignore($this->route()->parameter('id'))],
            "status"=>['sometimes','string',Rule::in('active','disable')],
            'is_vip' => ['sometimes', 'boolean'],
            "role" => ['sometimes', 'string', new EnumRule(UserRoleEnum::class)],
        ];
    }
}
