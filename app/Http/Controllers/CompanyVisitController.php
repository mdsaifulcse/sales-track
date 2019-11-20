<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CompanyVisit;
use App\Models\FollowUp;
use App\User;
use Illuminate\Http\Request;
use Validator,Auth,DB;
use Yajra\DataTables\DataTables;

class CompanyVisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authRole=\MyHelper::userRole()->role;
        $users=User::leftJoin('role_user','role_user.user_id','users.id')
            ->leftJoin('roles','roles.id','role_user.role_id')
            ->select('users.id',DB::raw('CONCAT(users.name, " ( ", roles.name, " )") as userName'))
            ->where('users.status',1)->where('roles.slug','=','stuff')
            ->orderBy('users.id','desc')->pluck('userName','users.id');

        return view('backend.company-visit.index',compact('authRole','users'));
    }

    protected function showAllVisitedList(Request $request){

        $visitedData=CompanyVisit::leftJoin('follow_ups','follow_ups.company_visit_id','company_visits.id')
            ->leftJoin('users','users.id','follow_ups.follow_up_by')
            ->leftJoin('categories','categories.id','company_visits.category_id')
            ->select('users.name','categories.category_name','follow_ups.follow_date','follow_ups.contact_name','follow_ups.contact_mobile',
                'follow_ups.contact_email','follow_ups.discussion_summery','follow_ups.status_reason','company_visits.*')
            ->where('follow_ups.follow_up_step','1')->orderBy('company_visits.id','DESC');

        if (isset($request->follow_up_by) && $request->follow_up_by!=null){
            $visitedData=$visitedData->where('follow_ups.follow_up_by',$request->follow_up_by);
        }

        if (isset($request->start_date) && $request->start_date!=null && isset($request->end_date) && $request->end_date!=null){
            $startDate=date('Y-m-d',strtotime($request->start_date));
            $endDate=date('Y-m-d',strtotime($request->end_date));

            $visitedData=$visitedData->whereBetween('follow_ups.follow_date',[$startDate, $endDate]);
        }else if (isset($request->start_date) && $request->start_date!=null){
            $followUpDate=date('Y-m-d',strtotime($request->start_date));
            $visitedData=$visitedData->where('follow_ups.follow_date',$followUpDate);

        }else if (isset($request->end_date) && $request->end_date!=null){
            $followUpDate=date('Y-m-d',strtotime($request->end_date));
            $visitedData=$visitedData->where('follow_ups.follow_date',$followUpDate);
        }


        if(\MyHelper::userRole()->role=='stuff') {
            $visitedData = $visitedData->where('follow_ups.follow_up_by',Auth::user()->id);
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
 @endif ')
    ->addColumn('Action','
            <div class="dropdown ">
  <button class="no-padding" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Action
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu action-dropdown " aria-labelledby="dLabel">
   @role(\'stuff\')
    <li><a href="{{URL::to(\'client-follow-up/\'.$id)}}" title="Click here to follow up" class="btn btn-primary btn-xs" > Follow up </a></li>
    @endRole
    
    <li><a href="javascript:void(0);" onclick="visitDetails({{$id}})" title="Click here to view Details" class="btn btn-primary btn-xs" >Details</a></li>
    <!--<li> <a  href="{{URL::to(\'company-visit/\'.$id)}}" title="Click here to view student information" class="btn btn-danger btn-xs" >Details</a></li>-->
     @role(\'developer\')
    <li><a href="{{URL::to(\'company-visit/\'.$id)}}/edit" title="Click here to update information" class="btn btn-warning btn-xs" ><i class="fa fa-pencil no-margin"></i> Edit</a>
    </li>
    <li>
    {!! Form::open(array(\'route\'=> [\'company-visit.destroy\',$id],\'method\'=>\'DELETE\',\'class\'=>\'deleteForm\',\'id\'=>"deleteForm$id")) !!}
            {{ Form::hidden(\'id\',$id)}}
            <button type="button" onclick=\'return deleteConfirm("deleteForm{{$id}}");\' class="deleteBtn btn btn-danger btn-xs">
              <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
            </button>
        {!! Form::close() !!}
    </li>
    @endRole
  </ul>
</div>')
            ->rawColumns(['Date','Status','Action'])
            ->toJson();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $categories=Category::orderBy('id','desc')->pluck('category_name','id');
        return view('backend.company-visit.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateFields=[
            'visited_company' => 'required|max:200',
            'contact_mobile'  => "required|min:11|max:11|regex:/(01)[0-9]{9}/",
            'contact_email'  => "email|max:140",
            'category_id'  => "required|exists:categories,id",
            'product_name' => 'required|max:250',
            'discussion_summery' => 'required|max:499',
            'status' => 'required',
            'status_reason' => 'required|max:254',
            'quotation_value' => 'numeric|nullable|required_if:status,4',
        ];

        $validator = Validator::make($request->all(), $validateFields);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();

        DB::beginTransaction();
        try{
            if ($request->hasFile('product_doc_file')){
                $file = $request->file('product_doc_file');

                $uploadPath='product_file/'.date('Y/m/d/');
                if (!is_dir($uploadPath)) {
                    mkdir("$uploadPath", 0777, true);
                }
                $fileName=rand(1, 10000).str_replace(' ','-',$request->file('product_doc_file')->getClientOriginalName());

               $file->move(public_path($uploadPath), $fileName);
                $input['product_doc_file']=$uploadPath.$fileName;
            }

            $input['follow_date']=isset($request->follow_date)?date('Y-m-d',strtotime($request->visited_date)):date('Y-m-d h:i:s');

            $input['follow_up_by']=Auth::user()->id;
            $input['created_by']=Auth::user()->id;

            if ($request->quotation_value==null){
                $input['quotation_value']=00;
            }

            //return $input;

            $companyVisit=CompanyVisit::create($input);
            $input['company_visit_id']=$companyVisit->id;
            $input['follow_up_step']=1;
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
     * @param  \App\Models\CompanyVisit  $companyVisit
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $companyVisit=CompanyVisit::with('companyVisitFollowUp','visitedCategory')->findOrFail($id);
        return view('backend.company-visit.show',compact('companyVisit'));
    }

    public function companyVisitDetails($id){

        $companyVisit=CompanyVisit::with('companyVisitFollowUp','visitedCategory')->findOrFail($id);
        return view('backend.company-visit.company-visit-details-modal',compact('companyVisit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanyVisit  $companyVisit
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyVisit $companyVisit)
    {
          if (\MyHelper::userRole()->role=='stuff'){
              return redirect()->back()->with('error','Your are not permitted to perform this action');
          }

        $categories=Category::orderBy('id','desc')->pluck('category_name','id');
        return view('backend.company-visit.edit',compact('categories','companyVisit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyVisit  $companyVisit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyVisit $companyVisit)
    {
        //return $companyVisit;

        $validateFields=[
            'visited_company' => 'required|max:200',
            'contact_mobile'  => "required|min:11|max:11|regex:/(01)[0-9]{9}/",
            'contact_email'  => "email|max:140",
            'category_id'  => "required|exists:categories,id",
            'product_name' => 'required|max:250',
            'discussion_summery' => 'required|max:499',
            'status' => 'required',
            'status_reason' => 'required|max:254',
            'quotation_value' => 'numeric|nullable|required_if:status,4',
        ];

        $validator = Validator::make($request->all(), $validateFields);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();

        DB::beginTransaction();
        try{
            if ($request->hasFile('product_doc_file')){
                $file = $request->file('product_doc_file');

                $uploadPath='product_file/'.date('Y/m/d/');
                if (!is_dir($uploadPath)) {
                    mkdir("$uploadPath", 0777, true);
                }
                $fileName=rand(1, 10000).str_replace(' ','-',$request->file('product_doc_file')->getClientOriginalName());

                $file->move(public_path($uploadPath), $fileName);

                $input['product_doc_file']=$uploadPath.$fileName;

                if (!empty($companyVisit->product_doc_file)){
                    if (file_exists($companyVisit->product_doc_file)){
                        unlink($companyVisit->product_doc_file);
                    }
                }

            }

            $input['updated_by']=Auth::user()->id;

            if ($request->quotation_value==null){
                $input['quotation_value']=00;
            }

            $companyVisit->update($input);

            $followUpData=FollowUp::where('company_visit_id',$companyVisit->id)->first();
            if (!empty($followUpData)){
                $followUpData->update($input);
            }

            DB::commit();
            $bug=0;
        }catch(Exception $e){
            DB::rollback();
            $bug=$e->errorInfo[1];
            $bug2=$e->errorInfo[1];
        }
        if($bug==0){
            return redirect()->back()->with('success','Data Successfully Updated');
        }elseif($bug==1062){
            return redirect()->back()->with('error','The Email has already been taken.');
        }else{
            return redirect()->back()->with('error','Something Error Found ! '.$bug2);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyVisit  $companyVisit
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyVisit $companyVisit)
    {
        if (\MyHelper::userRole()->role=='stuff'){
            return redirect()->back()->with('error','Sorry, Your are not permitted to perform this action');
        }
       // $data = CompanyVisit::findOrFail($id);

        try {

            $followUp=FollowUp::where('company_visit_id',$companyVisit->id)->get();

            if (count($followUp)>0){
                foreach ($followUp as $followData){
                    $followData->delete();
                }
            }

            if (!empty($companyVisit->product_doc_file)){
                if (file_exists($companyVisit->product_doc_file)){
                    unlink($companyVisit->product_doc_file);
                }
            }

            $companyVisit->delete();

            $bug = 0;

        } catch (\Exception $e) {
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
