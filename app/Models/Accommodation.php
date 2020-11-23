<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    protected $table='accommodations';
    protected $fillable=['emp_expenditure_id','hotel_name','hotel_address','contact_name','contact_phone','contact_email','no_of_night','facilities','status','created_by','updated_by'];
}
