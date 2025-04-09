<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Morilog\Jalali\Jalalian;

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

    /**
     * @param $finishedAt
     * @return string|null
     */
    public function getFinishedAtAttribute($finishedAt): ?string
    {
        return $finishedAt != null ? convertLatinDateToPersian($finishedAt) : null;
    }
}
