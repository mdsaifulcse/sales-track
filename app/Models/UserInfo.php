<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table='user_infos';
    protected $fillable=['user_id','father_name', 'mother_name','nid','','joining_date','release_date','salary','designation_id','district_id','thana_upazila_id',
        'serial_num','status','subordinate','created_by','updated_by'];

    public function userDesignation(){
        return $this->belongsTo(Designation::class,'designation_id','id');
    }

//    public function userData(){
//        return $this->belongsTo(User::class,'user_id','id');
//    }
//
//    public function userInfoVillage(){
//        return $this->belongsTo(Village::class,'village_id','id');
//    }
//
//    public function userInfoBatch(){
//        return $this->belongsTo(Batch::class,'batch_id','id');
//    }
//
//    public function userInfoUnion(){
//        return $this->belongsTo(Union::class,'union_id','id');
//    }
//
//    public function userInfoThana(){
//        return $this->belongsTo(ThanaUpazila::class,'thana_upazila_id','id');
//    }
//    public function userInfoDist(){
//        return $this->belongsTo(District::class,'district_id','id');
//    }
//    public function receivedBy(){
//        return $this->belongsTo(User::class,'received_by','id');
//    }


}
