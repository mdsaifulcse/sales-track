<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrimaryInfo extends Model
{
    protected $table='primary_info';
    protected $fillable=['company_name','logo','favicon','address1','address2','mobile','phone','email','type'];
}
