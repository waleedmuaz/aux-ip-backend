<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FashionCompany extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        "reference",
        "ip_type",
        "application",
        "application_numbers",
        "application_filing_date",
        "patent_numbers",
        "grant_date",
        "country",
        "due_date",
        "last_instruction_date",
        "action_type",
        "estimated_cost",
    ];
}
