<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table='contents';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        "name",
        "key",
        "page",
        "status",
    ];


    public function context(){
        return $this->hasMany(Context::class,'content_id','id');
    }
}
