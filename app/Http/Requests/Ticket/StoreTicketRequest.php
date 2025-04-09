<?php

namespace App\Http\Requests\Ticket;

use App\Enums\DepartmentTicketEnum;
use App\Enums\PriorityTicketEnum;
use App\Enums\StatusTicketEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\ProhibitedIf;
use Illuminate\Validation\Rules\RequiredIf;
use Spatie\Enum\Laravel\Rules\EnumRule;

class StoreTicketRequest extends FormRequest
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
            'parent_id' => [new RequiredIf(!$this->has('department') && !$this->has('title') && !$this->has('priority')), 'integer', 'exists:tickets,id'],
            'title' => [new ProhibitedIf($this->has('parent_id')), new RequiredIf(!$this->has('parent_id')), 'string'],
            'description' => ['required', 'string'],
            "root_id" => ['sometimes', 'integer', 'exists:tickets,id'],
            "status" => [new RequiredIf($this->has('root_id')), 'string', new EnumRule(StatusTicketEnum::class)],
            'priority' => [new ProhibitedIf($this->has('parent_id')), new RequiredIf(!$this->has('parent_id')), new EnumRule(PriorityTicketEnum::class)],
            'department' => [new ProhibitedIf($this->has('parent_id')), new RequiredIf(!$this->has('parent_id')), 'string', new EnumRule(DepartmentTicketEnum::class)],
        ];
    }
}
