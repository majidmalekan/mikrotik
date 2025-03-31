<?php

namespace App\Models;

use App\Enums\DepartmentTicketEnum;
use App\Enums\PriorityTicketEnum;
use App\Enums\StatusTicketEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kalnoy\Nestedset\NodeTrait;

class Ticket extends BaseModel
{
    use NodeTrait,HasFactory;


    protected $hidden=[
        "_lft",
        "_rgt"
    ];
    protected $casts=[
        "priority" => PriorityTicketEnum::class,
        "status" => StatusTicketEnum::class,
        "department" => DepartmentTicketEnum::class,
    ];

    public function userIdTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_to');
    }

    public function userIdFrom(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_from');
    }

    public function toArray(): array
    {
        $attributes = $this->attributesToArray();
        $attributes = array_merge($attributes, $this->relationsToArray());

        if (empty($attributes['children'])) {
            unset($attributes['children']);
        }

        unset($attributes['pivot']);

        return $attributes;
    }
}
