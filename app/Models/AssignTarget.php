<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class AssignTarget extends Model
{
    protected $table='assign_targets';
    protected $fillable=['user_id','target_year','target_months','quarterly_amount','quarterly_achieve_amount','status','created_by','updated_by'];

    public function userOfTarget(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
