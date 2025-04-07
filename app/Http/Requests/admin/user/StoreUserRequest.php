<?php

namespace App\Http\Requests\admin\user;

use App\Enums\UserRoleEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;
use Spatie\Enum\Laravel\Rules\EnumRule;

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
            'is_vip' => ['required', 'boolean'],
            "status"=>['required','string',Rule::in('active','disable')],
            "role" => ['required', 'string', new EnumRule(UserRoleEnum::class)],
            'traffic_limit' => [new RequiredIf(!$this->input('is_vip')),]
        ];
    }
}
