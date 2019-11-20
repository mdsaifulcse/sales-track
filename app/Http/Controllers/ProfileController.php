<?php

namespace App\Http\Controllers;

use App\Model\AcademicInformation;
use App\Model\Attendance;
use App\Model\Branch;
use App\Model\ExamAns;
use App\Model\ExamQuestion;
use App\Model\PrimaryInfo;
use App\Model\ProgramStudies;
use App\Model\StudentPayment;
use Illuminate\Http\Request;
use App\User;
use App\Model\UserInfo;
use Auth;
use DB;
use MyHelper;

use Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::findOrFail(\Auth::user()->id);
        return view('backend.primary_info.profile.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = \Auth::user()->id;
        $data=User::findOrFail(\Auth::user()->id);

        $validator = Validator::make($request->all(), [
            'name'          => 'required|max:50',
            'email'         => "email|required|unique:users,email,$id"
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input=$request->all();



        if ($request->hasFile('image')){
           $input['image']=MyHelper::photoUpload($request->file('image'),'images/users/',120,100);


            if (file_exists($data->image)){
                unlink($data->image);
            }
        }

        /*return $input;*/
       
        try{

             $data->update($input);
            $bug=0;
        }catch(\Exception $e){
            $bug = $e->errorInfo[1];
        }

        if($bug==0){
            return redirect()->back()->with('success','Profile Successfully Updated');
        }elseif($bug==1062){
            return redirect()->back()->with('error','The name has already been taken.');
        }else{
            return redirect()->back()->with('error','Something Error Found ! ');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.primary_info.profile.password');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = \Auth::user()->id;
        $input=$request->all();
        $newPass=$input['password'];
        $data=User::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'password' => 'required|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input['password']=bcrypt($newPass);
        try{
            $data->update($input);
            $bug=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }
        if($bug==0){
            return redirect()->back()->with('success','Password Changed Successfully !');
        }else{
            return redirect()->back()->with('error','Something is wrong !');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function myprofile(){
        $branch=Branch::findOrFail(\Auth::user()->branch);

        $info = UserInfo::where('user_id',Auth::user()->id)->first();
        if($info==''){
            return redirect()->back();
        }

        $bkashPayment=StudentPayment::where('user_id',Auth::user()->id)->whereNotNull('trx_id')->sum('amount');
        $cashPayment=StudentPayment::where('user_id',Auth::user()->id)->whereNull('trx_id')->sum('amount');

        $due=$info->payable_amount-($bkashPayment+$cashPayment);
        $companyInfo=PrimaryInfo::first();
        $academicInfo=AcademicInformation::where('user_id',\Auth::user()->id)->get();
        $programOfStudies=ProgramStudies::with(['courseOfProgramStudy','subCourseOfProgramStudy'])->where('user_id',\Auth::user()->id)->get();
        return view('backend.student-register.informationview',compact('branch','info','due','companyInfo','academicInfo','programOfStudies'));

    }

    public function viewprofile(){
        $branch=Branch::findOrFail(\Auth::user()->branch);

        $info = UserInfo::where('user_id',Auth::user()->id)->first();
        if($info==''){
            return redirect()->back();
        }

        $bkashPayment=StudentPayment::where('user_id',Auth::user()->id)->whereNotNull('trx_id')->sum('amount');
        $cashPayment=StudentPayment::where('user_id',Auth::user()->id)->whereNull('trx_id')->sum('amount');

        $due=$info->payable_amount-($bkashPayment+$cashPayment);
        $companyInfo=PrimaryInfo::first();
        $academicInfo=AcademicInformation::where('user_id',\Auth::user()->id)->get();
        $programOfStudies=ProgramStudies::with(['courseOfProgramStudy','subCourseOfProgramStudy'])->where('user_id',\Auth::user()->id)->get();
        return view('backend.myprofile.profile',compact('branch','info','due','companyInfo','academicInfo','programOfStudies'));
    }


    protected function showStudentDashboard(){

        $attendances=Attendance::select('attendance')->where('user_id',\Auth::user()->id)->get();
        $userInfo=UserInfo::where('user_id',\Auth::user()->id)->first();
        $branch=Branch::select('name')->where('id',Auth::user()->branch)->value('name');
        $lineChart[]="total_marks'=>00 'obtain_marks'=>00";
        $myResult=ExamAns::leftJoin('exams','exams.id','exam_ans.exam_id')
            ->leftJoin('exam_ans_question','exams.id','exam_ans.exam_id')
            ->select('exams.exam_name','exam_ans.*')
            ->where('user_id',\Auth::user()->id)->orderBy('id','desc')->first();
        $totalMarks=0;

        if ($myResult!=''){
            $totalMarks=ExamQuestion::select(DB::raw('sum(marks) as total_marks'))->where('exam_id',$myResult->exam_id)->value('total_marks');
        }

        $paymentInfo=ProgramStudies::where(['user_id'=>\Auth::user()->id,'status'=>2])
           ->select('id',DB::raw('SUM(payable_amount-discount_amount) AS totalPayable'),DB::raw('SUM(total_paid) AS totalPaid'),
               DB::raw('SUM(payable_amount-(discount_amount+total_paid)) AS dueAmount')
               )->get();

        return view('backend.myprofile.student-dashboard',compact('attendances','userInfo','branch','lineChart','myResult','totalMarks','paymentInfo'));
    }

}
