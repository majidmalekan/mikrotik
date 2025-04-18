<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends BaseModel
{
    use HasFactory;

    protected $fillable = ['question', 'answer'];
    protected $table = "f_a_q_s";
}
