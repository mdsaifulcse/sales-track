<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table='page';
    protected $fillable=['name','name_bn','title','title_ban','description','description_ban','status','link','file','serial_num'];
}
