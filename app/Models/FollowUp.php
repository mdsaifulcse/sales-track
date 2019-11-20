<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    protected $table='follow_ups';
    protected $fillable=['company_visit_id','follow_date','contact_name','contact_mobile','contact_email','discussion_summery','status','status_reason','competitor_details','existing_system_details','quotation_value','follow_up_step','follow_up_by','associate_by','created_by','updated_by'];


    public function followUpCompany(){
        return $this->belongsTo(CompanyVisit::class,'company_visit_id','id');
    }

}
