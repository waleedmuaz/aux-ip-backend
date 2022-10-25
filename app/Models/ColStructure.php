<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColStructure extends Model
{
    protected $table="structure_col_for_instruction";
    protected $fillable=['field','status','hidden','editable_col'];
    use HasFactory;
}
