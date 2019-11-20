<?php

namespace App\Models;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $fillable = ['title','role_id','link','user_id','user_id_skip','branch_id'];


    public function read(){
        return $this->hasOne(NotificationRead::class,'notification_id','id')->where('read_by',Auth::user()->id);
    }

}
