<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetworkLog extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        "ip_address",
        "mac_address",
        "download_bytes",
        "upload_bytes",
        "finished_at"
    ];

    protected $casts = [
        "finished_at" => "datetime",
    ];
}
