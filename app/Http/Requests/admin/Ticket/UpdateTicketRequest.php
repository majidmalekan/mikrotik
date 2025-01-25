<?php

namespace App\Http\Requests\admin\Ticket;

use App\Enums\PriorityTicketEnum;
use App\Enums\StatusTicketEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\Enum\Laravel\Rules\EnumRule;

class UpdateTicketRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'description' => ['required', 'string'],
            'parent_id' => ['required', 'integer', 'exists:tickets,id'],
        ];
    }
}
