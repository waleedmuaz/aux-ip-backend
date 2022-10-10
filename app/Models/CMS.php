<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CMS extends Model
{
    protected $table="cms_media";
    protected $fillable=['name','image'];
    use HasFactory;
}
