<?php

namespace App\Http\Requests\Mikrotik;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;

class GetTrafficRequest extends FormRequest
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
            'username' => [new RequiredIf(!$this->has('queue_name')&&!$this->has('interface_name'))],
            'queue_name' => [new RequiredIf(!$this->has('username')&&!$this->has('interface_name'))],
            'interface_name' => [new RequiredIf(!$this->has('username')&&!$this->has('queue_name'))],
        ];
    }
}
