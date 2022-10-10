<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstructorLogs extends Model
{
    protected $table='instruction_logs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        "user_id",
        "fashion_company_id",
        "instruction_applied_date",
        "instruction_array",
        'status'
    ];
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function instruction(){
        return $this->hasOne(FashionCompany::class,'id','fashion_company_id');
    }
}
