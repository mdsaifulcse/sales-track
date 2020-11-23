<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyRemaining extends Model
{
    protected $table='monthly_remainings';
    protected $fillable=['user_id','month_name','remaining_amount'];

}
