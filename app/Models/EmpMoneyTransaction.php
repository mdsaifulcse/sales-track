<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpMoneyTransaction extends Model
{
    protected $table='emp_money_transactions';
    protected $fillable=['emp_expenditure_id','from_user_id','to_user_id','amount','details','transaction_type','transaction_status','status','created_by','updated_by'];
}
