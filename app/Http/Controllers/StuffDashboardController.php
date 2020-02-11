<?php

namespace App\Http\Controllers;
use App\Models\AssignTarget;
use Illuminate\Support\Facades\Artisan;
use App\Models\PrimaryInfo;
use PDF;
use Illuminate\Http\Request;
use Validator,Auth,DB,CommonWork;
use Yajra\DataTables\DataTables;
use App\Models\Category;
use App\Models\CompanyVisit;
use App\Models\FollowUp;
use App\User;

class StuffDashboardController extends Controller
{
    public function dashboardForStuff(){

         $company_visit_ids=FollowUp::select('company_visit_id')
            ->where('follow_up_by',Auth::user()->id)->groupBy('company_visit_id')->get()->toArray();

         $followYear=FollowUp::select(DB::raw('Year(follow_date) followYear'))
             ->where('follow_up_by',Auth::user()->id)->orderBy('followYear','DESC')->groupBy('followYear')->pluck('followYear','followYear');

        $totalCompanyVisit= count($company_visit_ids);

      $goalCompletions=FollowUp::select(DB::raw('COUNT(status)as goadCompletion'),'status')
          ->whereIn('company_visit_id',$company_visit_ids)->whereYear('follow_date','=',date('Y'))->where(['latest'=>1])
          ->groupBy('status')->get();

      $followStatus=CommonWork::status();

      $goalCompletionsData=[];
      foreach ($goalCompletions as $goal){
          array_push($goalCompletionsData,[$followStatus[$goal->status],$goal->goadCompletion]);
      }

       unset($followStatus['2']);
       unset($followStatus['5']);

       $myTargetYears=AssignTarget::where(['user_id'=>Auth::user()->id,'target_year'=>date('Y')])->orderBy('id','DESC')
          ->groupBy('target_year')->pluck('target_year','target_year');
       $myAnnualTarget=AssignTarget::where(['user_id'=>Auth::user()->id,'target_year'=>date('Y')])->orderBy('id','DESC')->get();

        return view('backend.dashboard.stuff-dashboard',compact('followYear','goalCompletionsData','totalCompanyVisit','followStatus','myAnnualTarget','myTargetYears'));
    }

    public function goalCompletion(Request $request){

        $startDate='';
        $endDate='';

        if (isset($request->start_date) && $request->start_date!=''){
            $startDate=date('Y-m-d',strtotime($request->start_date));
        }else{
            return false;
        }
        if (isset($request->end_date) && $request->end_date!=''){
            $endDate=date('Y-m-d',strtotime($request->end_date));
        }else{
            return false;
        }

        $company_visit_ids=FollowUp::select('company_visit_id')
            ->where('follow_up_by',Auth::user()->id)->groupBy('company_visit_id')->get()->toArray();

        $goalCompletions=FollowUp::select(DB::raw('COUNT(status)as goadCompletion'),'status')
            ->whereIn('company_visit_id',$company_visit_ids)->where(['latest'=>1]);

        if ($startDate!='' && $endDate!=''){
            $goalCompletions=$goalCompletions->whereBetween('follow_date',[$startDate,$endDate]);
        }

        $goalCompletions=$goalCompletions->groupBy('status')->get();


        $followStatus=CommonWork::status();

        $goalCompletionsData=[];
        foreach ($goalCompletions as $goal){
            array_push($goalCompletionsData,[$followStatus[$goal->status],$goal->goadCompletion]);
        }

        return response()->json(['goalCompletionsData'=>$goalCompletionsData]);
    }


    protected function getTargetYearDetails($targetYear){

        $myAnnualTarget=AssignTarget::where(['user_id'=>Auth::user()->id,'target_year'=>$targetYear])->orderBy('id','DESC')->get();
        return view('backend.dashboard.target-year-data',compact('myAnnualTarget'));
    }



    public function showMyAllVisitedList(Request $request)
    {

        $dailyVisitData=CompanyVisit::leftJoin('follow_ups','follow_ups.company_visit_id','company_visits.id')
            ->leftJoin('users','users.id','follow_ups.follow_up_by')
            ->leftJoin('categories','categories.id','company_visits.category_id')
            ->select('users.name','categories.category_name','company_visits.product_name','company_visits.visited_company','company_visits.quotation_value',
                'company_visits.visited_company_address','follow_ups.follow_date','follow_ups.contact_name','follow_ups.contact_mobile','follow_ups.contact_email','follow_ups.status','follow_ups.id')->where('follow_ups.follow_up_by',\Auth::user()->id)
            ->orderBy('follow_ups.id','DESC')->orderBy('follow_ups.company_visit_id','DESC');

        if (isset($request->status) && $request->status!=null){
            $dailyVisitData=$dailyVisitData->where('follow_ups.status',$request->status);
        }

        if (isset($request->start_date) && $request->start_date!=null && isset($request->end_date) && $request->end_date!=null){
            $startDate=date('Y-m-d',strtotime($request->start_date));
            $endDate=date('Y-m-d',strtotime($request->end_date));

            $dailyVisitData=$dailyVisitData->whereBetween('follow_ups.follow_date',[$startDate, $endDate]);
        }else if (isset($request->start_date) && $request->start_date!=null){
            $followUpDate=date('Y-m-d',strtotime($request->start_date));
            $dailyVisitData=$dailyVisitData->whereDate('follow_ups.follow_date', '>', $followUpDate);

        }else if (isset($request->end_date) && $request->end_date!=null){
            $followUpDate=date('Y-m-d',strtotime($request->end_date));
            $dailyVisitData=$dailyVisitData->where('follow_ups.follow_date','<',$followUpDate);
        }


        return DataTables::of($dailyVisitData)
            ->addIndexColumn()
            ->addColumn('DT_RowIndex','')
            ->addColumn('Date','<?php echo date(\'d-M-Y\',strtotime($follow_date))?>')
            ->addColumn('Status','@if($status==1)
                <span class="btn btn-default btn-xs"> Follow Up Need </span>
            @elseif($status==2)
                <span class="btn btn-warning btn-xs"> No Need Follow Up </span>
            @elseif($status==3)
                <span class="btn btn-warning btn-xs"> Need Quotation</span>
            @elseif($status==4)
                <span class="btn btn-primary btn-xs"> Quotation Submitted </span>
            @elseif($status==5)
                <span class="btn btn-danger btn-xs"> Fail to sale </span>
            @elseif($status==6)
                <span class="btn btn-success btn-xs"> Success to Sale </span>
            @elseif($status==7)
                <span class="btn btn-success btn-xs"> Technical Discussion </span>
            @elseif($status==8)
                <span class="btn btn-success btn-xs"> PI Needed </span>
            @elseif($status==9)
                <span class="btn btn-success btn-xs"> PI Submitted </span>
            @elseif($status==10)
                <span class="btn btn-success btn-xs">Draft LC Open </span>
            @elseif($status==11)
                <span class="btn btn-success btn-xs"> LC Open </span>
            @endif')
            ->addColumn('View Details','
            <a href="javascript:void(0);" onclick="dailyFollowUpDetails({{$id}})" title="Click here to view Details" class="btn btn-success btn-xs" >Details</a>
            <a href="{{URL::to(\'/my-follow-pdf/\'.$id)}}" target="_blank" title="Click here to download all follow up data" class="btn btn-primary btn-xs" style="margin-bottom: 5px;"> <i class="fa fa-download"></i>  </a>
            ')
            ->rawColumns(['Date','Status','View Details'])
            ->toJson();
    }



    public function dailyFollowUpDetail($followUpId){

        $lastFollowUpData=FollowUp::with('followUpCompany')
            ->where('id','=',$followUpId)->first();

        return view('backend.client-follow-up.follow-up-details-modal',compact('lastFollowUpData'));
    }



    protected function showMyAllFollowUpData(Request $request){

        $followUpdData=CompanyVisit::leftJoin('follow_ups','follow_ups.company_visit_id','company_visits.id')
            ->leftJoin('users','users.id','follow_ups.follow_up_by')
            ->leftJoin('categories','categories.id','company_visits.category_id')
            ->select('users.name','categories.category_name','follow_ups.id as follow_up_id','follow_ups.follow_date','follow_ups.contact_name','follow_ups.contact_mobile',
                'follow_ups.contact_email','follow_ups.discussion_summery','follow_ups.status_reason','company_visits.*')
           ->whereNotIn('company_visits.status',[2,5])->where(['follow_ups.follow_up_by'=>\Auth::user()->id,'follow_ups.latest'=>1])
            ->orderBy('follow_ups.id','DESC')->orderBy('company_visits.id','DESC')->groupBy('follow_ups.company_visit_id');

        if (isset($request->status) && $request->status!=null){
            $followUpdData=$followUpdData->where('company_visits.status',$request->status);
        }

        if (isset($request->start_date) && $request->start_date!=null && isset($request->end_date) && $request->end_date!=null){
            $startDate=date('Y-m-d',strtotime($request->start_date));
            $endDate=date('Y-m-d',strtotime($request->end_date));

            $followUpdData=$followUpdData->whereBetween('follow_ups.follow_date',[$startDate, $endDate]);

        }else if (isset($request->start_date) && $request->start_date!=null){

            $followUpDate=date('Y-m-d',strtotime($request->start_date));
            $followUpdData=$followUpdData->where('follow_ups.follow_date','>',$followUpDate);

        }else if (isset($request->end_date) && $request->end_date!=null){

            $followUpDate=date('Y-m-d',strtotime($request->end_date));
            $followUpdData=$followUpdData->where('follow_ups.follow_date','<',$followUpDate);
        }

        return DataTables::of($followUpdData)
            ->addIndexColumn()
            ->addColumn('DT_RowIndex','')
            ->addColumn('Date','<?php echo date(\'d-M-Y\',strtotime($follow_date))?>')
            ->addColumn('Status','
                @if($status==1)
                <span class="btn btn-default btn-xs"> Follow Up Need </span>
            @elseif($status==2)
                <span class="btn btn-warning btn-xs"> No Need Follow Up </span>
            @elseif($status==3)
                <span class="btn btn-warning btn-xs"> Need Quotation</span>
            @elseif($status==4)
                <span class="btn btn-primary btn-xs"> Quotation Submitted </span>
            @elseif($status==5)
                <span class="btn btn-danger btn-xs"> Fail to sale </span>
            @elseif($status==6)
                <span class="btn btn-success btn-xs"> Success to Sale </span>
            @elseif($status==7)
                <span class="btn btn-success btn-xs"> Technical Discussion </span>
            @elseif($status==8)
                <span class="btn btn-success btn-xs"> PI Needed </span>
            @elseif($status==9)
                <span class="btn btn-success btn-xs"> PI Submitted </span>
            @elseif($status==10)
                <span class="btn btn-success btn-xs">Draft LC Open </span>
            @elseif($status==11)
                <span class="btn btn-success btn-xs"> LC Open </span>
            @endif')
            ->addColumn('Follow Up','
              @if($status==11)
            
                <a href="javascript:void(0);" title="Click here for next follow up" class="btn btn-success btn-xs" style="margin-bottom: 5px;width: 100%"> Done <i class="fa fa-check"></i></a>
              @else
              
                  <a href="javascript:void(0);" onclick="newFollowUp({{$follow_up_id}})" title="Click here for next follow up" class="btn btn-success btn-xs" style="margin-bottom: 5px;width: 100%"><i class="fa fa-pencil"></i> Follow up</a>
              @endif
              
               <br>
                <a href="javascript:void(0);" onclick="dailyFollowUpDetails({{$follow_up_id}})" title="Click here to view last follow up Details" class="btn btn-info btn-xs" style="margin-bottom: 5px;width: 100%"><i class="fa fa-eye"></i> Last Follow Up</a>
                <a href="{{URL::to(\'/my-follow-pdf/\'.$follow_up_id)}}" target="_blank" title="Click here to download all follow up data" class="btn btn-primary btn-xs" style="margin-bottom: 5px;width: 100%"> <i class="fa fa-download"></i> Download </a>

                
               
    ')
            ->rawColumns(['Date','Status','Follow Up'])
            ->toJson();

    }

    public function myFollowUpPdf($followUpId){

        //Artisan::call('composer update');
        Artisan::call('cache:clear');
        Artisan::call('config:cache');

        $followUpData=FollowUp::findOrfail($followUpId);
        $companyAndProduct=CompanyVisit::with('visitedCategory')->findOrFail($followUpData->company_visit_id);

        $contact=FollowUp::select('contact_name','contact_mobile','contact_email','designation')->orderBy('id','DESC')
            ->where(['company_visit_id'=>$followUpData->company_visit_id,'latest'=>1])->first();

        $allFollowUpData=FollowUp::orderBy('id','DESC')
            ->where(['company_visit_id'=>$followUpData->company_visit_id])->get();

        $info=PrimaryInfo::first();
        $status=CommonWork::status();
        //return view('backend.pdf.all-follow-up',compact('info','companyAndProduct','allFollowUpData','contact','status'));

        $pdf = PDF::loadView('backend.pdf.all-follow-up', compact('info','companyAndProduct','allFollowUpData','contact','status'));
      return  $pdf->stream();
    }




}
