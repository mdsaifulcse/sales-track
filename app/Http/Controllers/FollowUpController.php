<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CompanyVisit;
use App\Models\FollowUp;
use Illuminate\Http\Request;
use Validator,Auth,DB;
use Yajra\DataTables\DataTables;

class FollowUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.client-follow-up.index');
    }

    public function showAllFollowUpData(Request $request)
    {

        $visitedData=CompanyVisit::leftJoin('follow_ups','follow_ups.company_visit_id','company_visits.id')
            ->leftJoin('users','users.id','follow_ups.follow_up_by')
            ->leftJoin('categories','categories.id','company_visits.category_id')
            ->select('users.name','categories.category_name','company_visits.product_name','company_visits.visited_company',
                'company_visits.visited_company_address','follow_ups.*')
            ->orderBy('follow_ups.status','DESC')->orderBy('follow_ups.company_visit_id','DESC');

        if(\MyHelper::userRole()->role=='stuff'){
            $visitedData=$visitedData->where('follow_ups.follow_up_by',\Auth::user()->id);
        }


        return DataTables::of($visitedData)
            ->addIndexColumn()
            ->addColumn('DT_RowIndex','')
            ->addColumn('Date','<?php echo date(\'d-M-Y\',strtotime($follow_date))?>')
            ->addColumn('Status','@if($status==1)<span class="btn btn-info btn-xs">Follow Up Need </span>
                @elseif($status==2)<span class="btn btn-info btn-xs">No Need Follow Up</span>
                @elseif($status==3)
                <span class="btn btn-warning btn-xs">Need Quotation </span>
                @elseif($status==4)
                <span class="btn btn-primary btn-xs">Quotation Submitted</span>
                @elseif($status==5)
                <span class="btn btn-danger btn-xs">Fail to sale</span>
                @elseif($status==6)
                <span class="btn btn-success btn-xs">Success to Sale</span>
                 @endif ')
            ->addColumn('Details','<li><a href="javascript:void(0);" onclick="visitDetails({{$id}})" title="Click here to view Details" class="btn btn-success btn-xs" >Details</a></li>')
            ->rawColumns(['Date','Status','Details'])
            ->toJson();

    }


    public function followUpDetails($followUpId){

        $companyVisit=FollowUp::with('followUpCompany')
            ->where('id','=',$followUpId)->first();

        return view('backend.client-follow-up.follow-up-details-modal',compact('companyVisit'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;

        $validateFields=[
            'contact_name'  => "required|max:150",
            'contact_mobile'  => "required|min:11|max:11|regex:/(01)[0-9]{9}/",
            'contact_email'  => "email|max:140",
            'discussion_summery' => 'required|max:499',
            'competitor_details' => 'nullable|max:499',
            'status' => 'required',
            'status_reason' => 'required|max:254',
            'company_visit_id' => 'required|exists:company_visits,id',
            'quotation_value' => 'numeric|nullable|required_if:status,4|required_if:status,6',
        ];

        $validator = Validator::make($request->all(), $validateFields);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();

        DB::beginTransaction();
        try{

            $input['follow_date']=isset($request->follow_date)?date('Y-m-d',strtotime($request->visited_date)):date('Y-m-d h:i:s');

            $input['company_visit_id']=$request->company_visit_id;
            $input['follow_up_by']=Auth::user()->id;
            $input['created_by']=Auth::user()->id;

            if ($request->quotation_value==null){
                $input['quotation_value']=00;
            }

            $companyVisit=CompanyVisit::findOrFail($request->company_visit_id);
            $companyVisit->update(['status'=>$request->status,
                'quotation_value'=>$input['quotation_value'],
                'updated_by'=>Auth::user()->id
            ]);

            FollowUp::create($input);

            DB::commit();
            $bug=0;
        }catch(Exception $e){
            DB::rollback();
            $bug=$e->errorInfo[1];
            $bug2=$e->errorInfo[1];
        }
        if($bug==0){
            return redirect()->back()->with('success','Data Successfully Saved');
        }elseif($bug==1062){
            return redirect()->back()->with('error','The Email has already been taken.');
        }else{
            return redirect()->back()->with('error','Something Error Found ! '.$bug2);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FollowUp  $followUp
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $companyVisit=CompanyVisit::leftJoin('follow_ups','follow_ups.company_visit_id','company_visits.id')
        ->select('follow_ups.*','company_visits.*')->where('follow_ups.company_visit_id',$id)->first();

        $categories=Category::orderBy('id','desc')->pluck('category_name','id');
        return view('backend.client-follow-up.create',compact('categories','companyVisit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FollowUp  $followUp
     * @return \Illuminate\Http\Response
     */
    public function edit(FollowUp $followUp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FollowUp  $followUp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FollowUp $followUp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FollowUp  $followUp
     * @return \Illuminate\Http\Response
     */
    public function destroy(FollowUp $followUp)
    {
        //
    }
}
