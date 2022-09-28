<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Context extends Model
{
    protected $table='context';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        "name",
        "key",
        "content_detail",
        "page",
        "type",
        "status",
        "content_id",
        "extra_detail_content",
    ];
}
