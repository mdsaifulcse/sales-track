<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationRead extends Model
{
    protected $table = 'notification_read';
    protected $fillable = ['notification_id','read_by'];
}
