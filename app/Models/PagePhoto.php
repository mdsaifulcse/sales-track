<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagePhoto extends Model
{
    protected $table='page_photo';
    protected $fillable=['photo','fk_page_id'];
}
