<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpExpenditure extends Model
{
    protected $table='emp_expenditures';
    protected $fillable=['user_id','expenditure_date','purpose','amount','phone_bill_trxid','miscellaneous','restaurant_name','docs_img','status','created_by','updated_by'];

    public function accommodationOfExpenditure(){
        return $this->hasOne(Accommodation::class,'emp_expenditure_id','id');
    }
    public function empMoneyTransactionExpenditure(){
        return $this->hasOne(EmpMoneyTransaction::class,'emp_expenditure_id','id');
    }

}
