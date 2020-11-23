<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoneyAssignToEmp extends Model
{
    protected $table='money_assign_to_emps';
    protected $fillable=['user_id','purpose','amount','assign_date','restaurant_name','car_maintenance_details','gasoline_details','driver_over_time_details','docs_img','type','status','created_by','updated_by'];

}
