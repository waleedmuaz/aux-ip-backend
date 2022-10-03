<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompniesUser extends Model
{
    protected $table="company_users";
    protected $fillable=['user_id','company_id'];
    use HasFactory;
}
