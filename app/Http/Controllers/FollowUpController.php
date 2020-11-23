<?php

namespace App\Http\Controllers;

use App\Models\AssignTarget;
use App\Models\Category;
use App\Models\CompanyVisit;
use App\Models\Designation;
use App\Models\FollowUp;
use App\User;
use function GuzzleHttp\Psr7\str;
use PDF;
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

       // return $d=FollowUp::orderBy('id','desc')->where('latest',1)->groupBy('company_visit_id')->get();

        $authRole=\MyHelper::userRole()->role;
        $users=User::leftJoin('role_user','role_user.user_id','users.id')
            ->leftJoin('roles','roles.id','role_user.role_id')
            ->select('users.id',DB::raw('CONCAT(users.name, " ( ", roles.name, " )") as userName'))
            ->where('users.status',1)->where('roles.slug','=','stuff')
            ->orderBy('users.id','desc')->pluck('userName','users.id');
        return view('backend.client-follow-up.index',compact('authRole','users'));
    }


    protected function showAllFollowUpData(Request $request){

        //return $request;

        $followUpdData=FollowUp::leftJoin('company_visits','company_visits.id','follow_ups.company_visit_id')
            ->leftJoin('users','users.id','follow_ups.follow_up_by')
            ->leftJoin('categories','categories.id','company_visits.category_id')
            ->select('users.name','categories.category_name', //DB::raw('MAX(follow_ups.id) as id'),
                'company_visits.visited_company','company_visits.product_name','company_visits.quotation_value','company_visits.status','follow_ups.id',
                'follow_ups.contact_name','follow_ups.contact_mobile','follow_ups.contact_email','follow_ups.follow_date')
            ->whereNotIn('company_visits.status',[2,5])
            ->where('follow_ups.latest',1)->orderBy('follow_ups.id','DESC')->groupby('follow_ups.company_visit_id');



        if (isset($request->follow_up_by) && $request->follow_up_by!=null){
            $followUpdData=$followUpdData->where('follow_ups.follow_up_by',$request->follow_up_by);
        }

        //return $followUpdData;

        if (isset($request->status) && $request->status!=null){
            $followUpdData=$followUpdData->where('company_visits.status',$request->status);
        }

        if (isset($request->start_date) && $request->start_date!=null && isset($request->end_date) && $request->end_date!=null){
            $startDate=date('Y-m-d',strtotime($request->start_date));
            $endDate=date('Y-m-d',strtotime($request->end_date));

            $followUpdData=$followUpdData->whereBetween('follow_ups.follow_date',[$startDate, $endDate]);

        }else if (isset($request->start_date) && $request->start_date!=null){

            $startDate=date('Y-m-d',strtotime($request->start_date));
            $followUpdData=$followUpdData->where('follow_ups.follow_date','>',$startDate);

        }else if (isset($request->end_date) && $request->end_date!=null){

            $endDate=date('Y-m-d',strtotime($request->end_date));
            $followUpdData=$followUpdData->where('follow_ups.follow_date','<',$endDate);
        }

        return DataTables::of($followUpdData)
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
            ->addColumn('Details', '
                @if($status==11)
                <a href="javascript:void(0);" onclick="lastFollowUpDetails({{$id}})" title="Nothing to action because this product successfully sale" class="btn btn-success btn-xs" >Done <i class="fa fa-check-circle"></i></a></li>
                @else
                <a href="javascript:void(0);" onclick="lastFollowUpDetails({{$id}})" title="Click here to view last follow up details" class="btn btn-success btn-xs" >Details</a></li>
                @endif
    ')
            ->rawColumns(['Date','Status','Details'])
            ->toJson();

    }





    public function lcOpenData()
    {

        // return $d=FollowUp::orderBy('id','desc')->where('latest',1)->groupBy('company_visit_id')->get();

        $authRole=\MyHelper::userRole()->role;
        $users=User::leftJoin('role_user','role_user.user_id','users.id')
            ->leftJoin('roles','roles.id','role_user.role_id')
            ->select('users.id',DB::raw('CONCAT(users.name, " ( ", roles.name, " )") as userName'))
            ->where('users.status',1)->where('roles.slug','=','stuff')
            ->orderBy('users.id','desc')->pluck('userName','users.id');
        return view('backend.client-follow-up.lc-open-list',compact('authRole','users'));
    }



    protected function showAlLlcOpenData(Request $request){

        //return $request;

        $followUpdData=FollowUp::leftJoin('company_visits','company_visits.id','follow_ups.company_visit_id')
            ->leftJoin('users','users.id','follow_ups.follow_up_by')
            ->leftJoin('categories','categories.id','company_visits.category_id')
            ->select('users.name','categories.category_name', //DB::raw('MAX(follow_ups.id) as id'),
                'company_visits.visited_company','company_visits.product_name','company_visits.quotation_value','company_visits.status','follow_ups.id',
                'follow_ups.contact_name','follow_ups.contact_mobile','follow_ups.contact_email','follow_ups.follow_date')
            ->whereIn('company_visits.status',[11])
            ->where('follow_ups.latest',1)->orderBy('follow_ups.id','DESC')->groupby('follow_ups.company_visit_id');



        if (isset($request->follow_up_by) && $request->follow_up_by!=null){
            $followUpdData=$followUpdData->where('follow_ups.follow_up_by',$request->follow_up_by);
        }

        //return $followUpdData;

        if (isset($request->status) && $request->status!=null){
            $followUpdData=$followUpdData->where('company_visits.status',$request->status);
        }

        if (isset($request->start_date) && $request->start_date!=null && isset($request->end_date) && $request->end_date!=null){
            $startDate=date('Y-m-d',strtotime($request->start_date));
            $endDate=date('Y-m-d',strtotime($request->end_date));

            $followUpdData=$followUpdData->whereBetween('follow_ups.follow_date',[$startDate, $endDate]);

        }else if (isset($request->start_date) && $request->start_date!=null){

            $startDate=date('Y-m-d',strtotime($request->start_date));
            $followUpdData=$followUpdData->where('follow_ups.follow_date','>',$startDate);

        }else if (isset($request->end_date) && $request->end_date!=null){

            $endDate=date('Y-m-d',strtotime($request->end_date));
            $followUpdData=$followUpdData->where('follow_ups.follow_date','<',$endDate);
        }

        return DataTables::of($followUpdData)
            ->addIndexColumn()
            ->addColumn('DT_RowIndex','')
            ->addColumn('Date','<?php echo date(\'d-M-Y\',strtotime($follow_date))?>')
            ->addColumn('Status',
                '@if($status==1)
                <span class="btn btn-default btn-xs"> Follow Up Need </span>
                @elseif($status==11)
                <span class="btn btn-success btn-xs"> LC Open </span>
                @endif')
            ->addColumn('Details', '
                @if($status==11)
                <a href="javascript:void(0);" onclick="lastFollowUpDetails({{$id}})" title="Click here to view Lc open details" class="btn btn-success btn-xs" >Details</a></li>
                <br>
                <br>
                <a href="{{URL::to(\'client-follow-up/\'.$id)}}/edit" title="Click here to view last follow up details" class="btn btn-warning btn-xs" >Edit <i class="fa fa-pencil-square"></i></a></li>
                @else
                @endif
    ')
            ->rawColumns(['Date','Status','Details'])
            ->toJson();

    }






    public function showAllFollowUpDataOld(Request $request) // first version development code --------
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
            ->addColumn('Details','<li><a href="javascript:void(0);" onclick="followUpDetails({{$id}})" title="Click here to view Details" class="btn btn-success btn-xs" >Details</a></li>')
            ->rawColumns(['Date','Status','Details'])
            ->toJson();

    }


    public function followUpDetails($followUpId){

        $lastFollowUpData=FollowUp::with('followUpCompany')
            ->where('id','=',$followUpId)->first();

        return view('backend.client-follow-up.follow-up-details-modal',compact('lastFollowUpData'));
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
    { // this action only for stuff user ----------
        //return $request;

        $validateFields=[
            'contact_name'  => "required|max:150",
            'contact_mobile'  => "required|min:8|max:50",
            'contact_email'  => "email|max:140",
            'designation'  => "required|max:140",
            'discussion_summery' => 'required|max:499',
            'competitor_details' => 'nullable|max:499',
            'status' => 'required',
            'status_reason' => 'required_if:status,!=4|max:254',
            'company_visit_id' => 'required|exists:company_visits,id',
            'quotation_value' => 'numeric|nullable|required_if:status,4|required_if:status,6',
        ];

        $validator = Validator::make($request->all(), $validateFields);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        if ($request->quotation_value==''){
            unset($input['quotation_value']);
        }
        if ($request->product_value==''){
            unset($input['product_value']);
        }
        if ($request->transport_cost==''){
            unset($input['transport_cost']);
        }

        //return $input;

        DB::beginTransaction();
        try{

            $input['follow_date']=isset($request->follow_date)?date('Y-m-d',strtotime($request->follow_date)):date('Y-m-d h:i:s');

            $input['company_visit_id']=$request->company_visit_id;
            $input['follow_up_by']=Auth::user()->id;
            $input['created_by']=Auth::user()->id;

            if ($request->quotation_value==null){
                $input['quotation_value']=00;
            }

            $companyVisit=CompanyVisit::findOrFail($request->company_visit_id);
            $data=[
                'status'=>$request->status,
                'updated_by'=>Auth::user()->id
            ];


            if (isset($input['quotation_value']) && $input['quotation_value']!=''){
                $data['quotation_value']=$input['quotation_value'];
            }

            if($input['pi_value']!=''){
                $data['quotation_value']= $input['pi_value'];
            }
            if(isset($input['product_value']) && $input['product_value']!=''){
                $data['quotation_value']= $input['product_value'];
            }


            $companyVisit->update($data);

            // update last follow up data as old (latest =0),
            $lastFollowUpData=FollowUp::where(['company_visit_id'=>$request->company_visit_id,'latest'=>1])->first();
            $lastFollowUpData->update(['latest'=>0]);


            $input['latest']=1;
            if (isset($input['status_reason']) && $input['status_reason']==''){
                $input['status_reason']=$lastFollowUpData->status_reason;
            }

            if (!isset($input['quotation_no'])){
                $input['quotation_no']=$lastFollowUpData->quotation_no;

            }elseif (isset($input['quotation_no']) && $input['quotation_no']==''){
                $input['quotation_no']=$lastFollowUpData->quotation_no;
            }

            if ($input['quotation_summary']==''){
                $input['quotation_summary']=$lastFollowUpData->quotation_summary;
            }
            if ($input['draft_lc_discuss']==''){
                $input['draft_lc_discuss']=$lastFollowUpData->draft_lc_discuss;
            }

            if ($input['quotation_value']==''){
                $input['quotation_value']=$lastFollowUpData->quotation_value;
            }
            if ($input['pi_value']==''){
                $input['pi_value']=$lastFollowUpData->pi_value;
            }
            if ($input['h_s_code']==''){
                $input['h_s_code']=$lastFollowUpData->h_s_code;
            }
            if ($input['pi_company']==''){
                $input['pi_company']=$lastFollowUpData->pi_company;
            }

            $lastInsertFollowUp=FollowUp::create($input);

            // update AssignTarget Table to update achievement column --------
            if (!empty($lastInsertFollowUp) && $lastInsertFollowUp->status==11){

                $targetMonths=date('m-Y',strtotime($lastInsertFollowUp->follow_date));

                $targetData=AssignTarget::where(['user_id'=>$lastInsertFollowUp->follow_up_by,
                    'target_year'=>date('Y',strtotime($lastInsertFollowUp->follow_date))])
                   ->where('target_months', 'like', '%'.$targetMonths.'%' )->first();
                if (!empty($targetData)){
                    $targetData->update(['quarterly_achieve_amount'=>$targetData->quarterly_achieve_amount+$lastInsertFollowUp->product_value]);
                }else{
                    return redirect('/stuff-dashboard')->with('error','You have not assign annual/quarterly target, Please contact your super admin to assign annual/quarterly target !');
                }
            }

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
    public function showNewFollowUpForm($id)
    {
        //follow-up-modal
        $companyVisit=CompanyVisit::leftJoin('follow_ups','follow_ups.company_visit_id','company_visits.id')
            ->select('follow_ups.*','company_visits.*')->where(['follow_ups.id'=>$id,'follow_ups.latest'=>1])->first();

        $categories=Category::orderBy('id','desc')->pluck('category_name','id');
        $designations=Designation::orderBy('id','desc')->pluck('designation','id');
        return view('backend.client-follow-up.follow-up-modal',compact('categories','companyVisit','designations'));
    }

    public function edit($id)
    {
        // edit follow up ----------
        if (\MyHelper::userRole()->role=='stuff'){
            return redirect()->back()->with('error','Your are not permitted to perform this action');
        }

       $followup=CompanyVisit::leftJoin('follow_ups','follow_ups.company_visit_id','company_visits.id')
            ->select('company_visits.*','follow_ups.*')->where('follow_ups.id',$id)->first();

        $categories=Category::orderBy('id','desc')->pluck('category_name','id');
        $designations=Designation::orderBy('id','desc')->pluck('designation','id');
        return view('backend.client-follow-up.edit',compact('categories','followup','designations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FollowUp  $followUp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    { // this action only for higher authority ------

        $followUp=FollowUp::findOrFail($id);
        $validateFields=[
            'contact_name'  => "required|max:150",
            'contact_mobile'  => "required|min:8|max:50",
            'contact_email'  => "email|max:140",
            'designation'  => "required|max:140",
            'discussion_summery' => 'required|max:499',
            'existing_system_details' => 'nullable|max:499',
            'competitor_details' => 'nullable|max:499',
            'category_id'  => "required|exists:categories,id",
            'product_name' => 'required|max:250',
            'status' => 'required|numeric',
            'status_reason' => 'required|max:254',
            'company_visit_id' => 'required|exists:company_visits,id',
            'quotation_value' => 'numeric|nullable|required_if:status,4|required_if:status,6',
            'product_value' => 'numeric|nullable|required_if:status,11',
            'follow_date' => 'required_if:status,11',
        ];

        $validator = Validator::make($request->all(), $validateFields);
        if ($validator->fails()) {return redirect()->back()->withErrors($validator)->withInput();}

        $input = $request->all();
        $input['company_visit_id']=$request->company_visit_id;
        $input['updated_by']=Auth::user()->id;
        $input['follow_up_by']=$followUp->follow_up_by;
        $input['created_by']=$followUp->created_by;
        $input['latest']=$followUp->latest;


        if ($request->quotation_value==''){
            unset($input['quotation_value']);
        }
        if ($request->product_value==''){
            unset($input['product_value']);
        }
        if ($request->transport_cost==''){
            unset($input['transport_cost']);
        }

        DB::beginTransaction();
        try{


            // update AssignTarget Table to update achievement column --------
            if ($followUp->status==11){

                $targetMonths=date('m-Y',strtotime($followUp->follow_date));

                $targetData=AssignTarget::where(['user_id'=>$followUp->follow_up_by,
                    'target_year'=>date('Y',strtotime($followUp->follow_date))])
                    ->where('target_months', 'like', '%'.$targetMonths.'%' )->first();

              // return $targetData->quarterly_achieve_amount;
               // return $followUp->product_value;

                if (!empty($targetData)){
                    $targetData->update(['quarterly_achieve_amount'=>max($targetData->quarterly_achieve_amount-$followUp->product_value,0)]);
                }
//                else{
//                    return redirect('/stuff-dashboard')->with('error','You have not assign annual/quarterly target, Please contact your super admin to assign annual/quarterly target !');
//                }
            }

            $followUp->delete();


            // new insert -------------------------------------------------------
            $companyVisit=CompanyVisit::findOrFail($request->company_visit_id);
            $input['follow_date']=isset($request->follow_date)?date('Y-m-d',strtotime($request->follow_date)):date('Y-m-d h:i:s');

            $input['company_visit_id']=$request->company_visit_id;

            if ($request->quotation_value==null){
                $input['quotation_value']=00;
            }

            $data=[
                'status'=>$request->status,
                'updated_by'=>Auth::user()->id
            ];

            if (isset($input['quotation_value']) && $input['quotation_value']!=''){
                $data['quotation_value']=$input['quotation_value'];
                //return 'q';
            }

            if($input['pi_value']!='' && $input['pi_value']>0){
                $data['quotation_value']= $input['pi_value'];
            }
            if(isset($input['product_value']) && $input['product_value']!='' && $input['product_value']>0){
                  $data['quotation_value']= $input['product_value'];
            }

            $companyVisit->update($data);

            // update last follow up data as old (latest =0),
            $lastFollowUpData=FollowUp::where(['company_visit_id'=>$request->company_visit_id])->orderBy('company_visit_id','DESC')->first();
            $lastFollowUpData->update(['latest'=>0]);

            if (isset($input['status_reason']) && $input['status_reason']==''){
                $input['status_reason']=$lastFollowUpData->status_reason;
            }

            if (!isset($input['quotation_no'])){
                $input['quotation_no']=$lastFollowUpData->quotation_no;

            }elseif (isset($input['quotation_no']) && $input['quotation_no']==''){
                $input['quotation_no']=$lastFollowUpData->quotation_no;
            }

            if ($input['quotation_summary']==''){
                $input['quotation_summary']=$lastFollowUpData->quotation_summary;
            }
            if ($input['draft_lc_discuss']==''){
                $input['draft_lc_discuss']=$lastFollowUpData->draft_lc_discuss;
            }

            if ($input['quotation_value']==''){
                $input['quotation_value']=$lastFollowUpData->quotation_value;
            }
            if ($input['pi_value']==''){
                $input['pi_value']=$lastFollowUpData->pi_value;
            }
            if ($input['h_s_code']==''){
                $input['h_s_code']=$lastFollowUpData->h_s_code;
            }
            if ($input['pi_company']==''){
                $input['pi_company']=$lastFollowUpData->pi_company;
            }

            $lastInsertFollowUp=FollowUp::create($input);

            // update AssignTarget Table to update achievement column --------
            if (!empty($lastInsertFollowUp) && $lastInsertFollowUp->status==11){

                $targetMonths=date('m-Y',strtotime($lastInsertFollowUp->follow_date));

                $targetData=AssignTarget::where(['user_id'=>$lastInsertFollowUp->follow_up_by,
                    'target_year'=>date('Y',strtotime($lastInsertFollowUp->follow_date))])
                    ->where('target_months', 'like', '%'.$targetMonths.'%' )->first();
                if (!empty($targetData)){
                    $targetData->update(['quarterly_achieve_amount'=>$targetData->quarterly_achieve_amount+$lastInsertFollowUp->product_value]);
                }else{
                    return redirect()->back()->with('error','have not assign annual/quarterly target for '. date('Y',strtotime($lastInsertFollowUp->follow_date)).'. Please contact your super admin to assign annual/quarterly target !');
                }
            }


            DB::commit();
            $bug=0;
        }catch(Exception $e){
            DB::rollback();
            $bug=$e->errorInfo[1];
            $bug2=$e->errorInfo[1];
        }
        if($bug==0){
            return redirect('client-follow-up/'.$lastInsertFollowUp->id.'/edit')->with('success','Data Successfully Saved');
        }else{
            return redirect()->back()->with('error','Something Error Found ! '.$bug2);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FollowUp  $followUp
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if (\MyHelper::userRole()->role=='stuff'){
            return redirect()->back()->with('error','Sorry, Your are not permitted to perform this action');
        }


        DB::beginTransaction();
        try {

            $followUp=FollowUp::findOrFail($id);
            // last data follow up data
            $lastFollowUp=FollowUp::where('company_visit_id',$followUp->company_visit_id)
                ->orderBy('id','DESC')->first();

            if ($lastFollowUp->id!=$id){
                return redirect()->back()->with('error','You can\'t delete previous follow up data, you ara allow to delete recent follow up data ');
            }


            $followUps=FollowUp::where('company_visit_id',$followUp->company_visit_id)->get();

            if (count($followUps)==1){
                foreach ($followUps as $followData){
                    $followData->delete();
                }

                $companyVisit=CompanyVisit::findOrFail($followUp->company_visit_id);

                if (!empty($companyVisit->product_doc_file)){
                    if (file_exists($companyVisit->product_doc_file)){
                        unlink($companyVisit->product_doc_file);
                    }
                }

                $companyVisit->delete();

            }else{


                $secondLastFollowUp=FollowUp::where('company_visit_id',$followUp->company_visit_id)->where('id','!=',$id)
                    ->orderBy('id','DESC')->first();

                if ($secondLastFollowUp!=''){
                    $companyVisitUpdateFiled=[
                        'status'=>$secondLastFollowUp->status,
                        'quotation_value'=>$secondLastFollowUp->quotation_value,
                        'updated_by'=>Auth::user()->id
                    ];

                    CompanyVisit::where('id',$followUp->company_visit_id)->update( $companyVisitUpdateFiled );

                }


                $followUp->delete();
            }

            $bug = 0;
            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }

        if($bug == 0){
            return redirect()->back()->with('success','Deleted Successfully.');
        }else if($bug==1451){
            return redirect()->back()->with('error','This data related with another module '.$bug1);
        }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.'.$bug1);
        }
    }


}
