<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessYear extends Model
{
    protected $table='business_years';
    protected $fillable=['year_name','status','created_by','updated_by'];
}
