<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{

    protected $table='designations';
    protected $fillable=['designation','status','created_by','updated_by'];

}
