<?php

namespace App\Http\Requests\Ticket;

use App\Enums\PriorityTicketEnum;
use App\Enums\StatusTicketEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [Rule::prohibitedIf($this->input('status') == StatusTicketEnum::Closed()->value),'sometimes', 'string'],
            'description' => [Rule::prohibitedIf($this->input('status') == StatusTicketEnum::Closed()->value),'sometimes', 'string'],
            'priority' => [Rule::prohibitedIf($this->input('status') == StatusTicketEnum::Closed()->value),'sometimes', new EnumRule(PriorityTicketEnum::class)],
            'status' => ['sometimes',new EnumRule(StatusTicketEnum::class)],
        ];
    }
}
