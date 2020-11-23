<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyVisit extends Model
{
    protected $table='company_visits';
    protected $fillable=['category_id','product_name','product_doc_file','visited_company','visited_company_address','status','quotation_value',
        'profit_value','currency_rate','profit_value_tk','profit_percent','created_by','updated_by','visited_by'];

    public function companyVisitFollowUp(){
        return $this->hasOne(FollowUp::class,'company_visit_id','id');
    }
    public function visitedCategory(){
        return $this->belongsTo(Category::class,'category_id','id');
    }


}
