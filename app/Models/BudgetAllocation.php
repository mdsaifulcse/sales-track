<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetAllocation extends Model
{
    protected $table='budget_allocations';
    protected $fillable=['allocation_date','purpose','amount','details','status','created_by','updated_by'];
}
