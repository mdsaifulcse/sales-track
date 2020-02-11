<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    protected $table='follow_ups';
    protected $fillable=['company_visit_id','follow_date','contact_name','contact_mobile','contact_email','designation_id','designation','discussion_summery','status','status_reason',
        'quotation_no','quotation_summary','technical_discuss','draft_lc_discuss','pi_value','h_s_code','pi_company','product_value','transport_cost','competitor_details','existing_system_details','quotation_value',
        'follow_up_step','latest','follow_up_by','associate_by','created_by','updated_by'];


    public function followUpCompany(){
        return $this->belongsTo(CompanyVisit::class,'company_visit_id','id');
    }
    public function contactPersonDesignation(){
        return $this->belongsTo(Designation::class,'designation_id','id');
    }

}
