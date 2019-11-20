<?php

namespace App\Http\Controllers;

use App\Model\Attendance;
use Illuminate\Http\Request;
use App\User;
use App\Models\UserInfo;
use DB;
use Auth,MyHelper;
use App\Models\SubMenu;
use App\Models\Menu;
use App\Models\SubSubMenu;


class DashboadController extends Controller
{

    public function dashboard(Request $request){
         $roleId = MyHelper::user()->role_id;
         if($roleId==4){
             return redirect('student-dashboard');
         }else if($roleId==3){
             $branch = MyHelper::user()->branch;
             $request = (object)['branch'=>$branch];
            return  self::branchWiseDashboard($request);
         }

        if(isset($request->branch)){
          return  self::branchWiseDashboard($request);
        }
        $branches = Branch::orderBy('branch_id','ASC')->get();
        $totalStd = [];
        $type = ['Booked','Registered','Admitted'];
        foreach($type as $key => $data){
            $totalStd[]=[
                    'label'=>$type[$key],
                    'value'=>ProgramStudies::where('status',$key)->count()
                ];
        }
        $date = date("Y-m-d");
        //$date = date("Y-m-d",strtotime('2019-06-16'));
       
       $dailyAdmission = ProgramStudies::whereDate('admission_date',$date)->where('status',2)->select(DB::raw('sum(payable_amount-discount_amount) as `payable_amount`'),DB::raw('count(program_studies.id) as `total_student`'))->first();
         $payableAmount = ProgramStudies::select(DB::raw('sum(payable_amount) as `payable_amounts`'),DB::raw('sum(discount_amount) as `discount_amounts`'))->where('status',2)->first();

        $totalPaid = ProgramStudies::select(DB::raw('sum(total_paid) as `total_paid`'))->value('total_paid');
        $dues = $payableAmount->payable_amounts -$payableAmount->discount_amounts - $totalPaid;
        $todayCollection = StudentPayment::whereDate('payment_date',$date)->select(DB::raw('sum(amount) as `total_amount`'))->value('total_amount');
        $todayAmount=[
            'daily_admission'=>$dailyAdmission,
            'today_collection'=>$todayCollection,
            'total_paid'=>$totalPaid,
            'dues'=>$dues,
        ];
        $branchName = 'All Branch';
         $courses = SubCourse::leftJoin('courses','course_id','courses.id')->select(DB::raw('CONCAT(courses.name,"-",sub_course) as "course_name"'))->orderBy('courses.id','DESC')->pluck('course_name');
    
        return view('backend.dashboard.index',compact('totalStd','branches','todayAmount','courses','request','branchName'));
    }

    public function branchWiseDashboard($request){
        $branch = $request->branch;
        $branchName = Branch::where('id',$request->branch)->value('name');
        $branches = Branch::orderBy('branch_id','ASC')->get();
        $totalStd = [];
        $type = ['Booked','Registered','Admitted'];
        foreach($type as $key => $data){
            $totalStd[]=[
                    'label'=>$type[$key],
                    'value'=>ProgramStudies::where(['status'=>$key,'branch_id'=>$branch])->count()
                ];
        }
        $date = date("Y-m-d");
        //$date = date("Y-m-d",strtotime('2019-06-16'));
       
       $dailyAdmission = ProgramStudies::whereDate('admission_date',$date)->where(['branch_id'=>$branch,'status'=>2])->select(DB::raw('sum(payable_amount-discount_amount) as `payable_amount`'),DB::raw('count(program_studies.id) as `total_student`'))->first();

        $payableAmount = ProgramStudies::where(['branch_id'=>$branch,'status'=>2])->select(DB::raw('sum(payable_amount-discount_amount) as `payable_amount`'))->where('status',2)->value('payable_amount');
        $paidAmount = ProgramStudies::where(['branch_id'=>$branch,'status'=>2])->select(DB::raw('sum(total_paid) as `paid_amount`'))->where('status',2)->value('paid_amount');
        $dues = $payableAmount - $paidAmount;
        $totalPaid = ProgramStudies::where('branch_id',$branch)->select(DB::raw('sum(total_paid) as `total_paid`'))->value('total_paid');
        $todayCollection = StudentPayment::leftJoin('program_studies','student_payment.user_id','program_studies.user_id')->whereDate('payment_date',$date)->where('branch_id',$branch)->select(DB::raw('sum(amount) as `total_amount`'))->value('total_amount');
        $todayAmount=[
            'daily_admission'=>$dailyAdmission,
            'today_collection'=>$todayCollection,
            'total_paid'=>$totalPaid,
            'dues'=>$dues,
        ];
        $courses = SubCourse::leftJoin('courses','course_id','courses.id')->select(DB::raw('CONCAT(courses.name,"-",sub_course) as "course_name"'))->orderBy('courses.id','DESC')->pluck('course_name');
    
        return view('backend.dashboard.index',compact('totalStd','branches','todayAmount','courses','request','branchName'));

    }
    public function totalStudents(Request $request,$type){
        $data= [];
        $branches = Branch::orderBy('branch_id','ASC')->get();
        $total = 0;
        foreach($branches as $branch){
            $students = ProgramStudies::where(['status'=>$type,'branch_id'=>$branch->id])->select(DB::raw('count(*) as total'))->value('total');
            $total +=$students;
            $data[]=[
                'label'=>$branch->name,
                'value'=>$students
            ];   
        }
        return response()->json(['data'=>$data,'total'=>$total],200);
    }
    public function yearlyPayment(Request $request,$year){
        if(isset($request->type) && $request->type=='summary'){
            $start = date('Y-m-d',strtotime($year));
            $end = date('Y-m-d',strtotime($request->end));
            $payment = StudentPayment::leftJoin('program_studies','student_payment.user_id','program_studies.user_id')->whereBetween('payment_date',[$start,$end])->select(DB::raw('sum(amount) as `total_amount`'),DB::raw("DATE_FORMAT(payment_date, '%d-%m-%Y') payment_dates"),DB::raw("DATE_FORMAT(payment_date, '%Y%m%d') payment_date_string"))
            ->groupBy('payment_dates')
            ->orderBy('payment_date_string','ASC');
            if(isset($request->branch)){
                $payment = $payment->where('branch_id',$request->branch);
            }
            $payment = $payment->get();
        }
        if(isset($request->type) && $request->type=='status'){
            $payment = ProgramStudies::whereYear('admission_date',$year)->select(DB::raw('sum(payable_amount) as `payable_amount`'),DB::raw('sum(total_paid) as `total_paid`'),DB::raw('sum(discount_amount) as `discount_amount`'));
            if(isset($request->branch)){
                $payment = $payment->where('branch_id',$request->branch);
            }
            $payment = $payment->first();
        }else if(isset($request->type) && $request->type=='course'){
            $payment = ProgramStudies::leftJoin('courses','course_id','courses.id')->whereYear('admission_date',$year)->select(DB::raw('sum(total_paid) as `total_paid`'),'course_id','courses.name')
            ->groupBy('course_id');
            if(isset($request->branch)){
                $payment = $payment->where('branch_id',$request->branch);
            }
            $payment = $payment->get();
        }


        return response()->json($payment,200);
    }



    // Home Iconic Menu (Hub and Spoke)
    public function home(){
        //setcookie("bkash_cookie", \Auth::user()->id,0,"/",'bkash.achievementcc.com');
        $menus = Menu::where(['status'=>1,'type'=>1])->orderBy('serial_num','ASC')->get();
        return view('backend.home.menu',compact('menus'));
    }
    public function subMenu(Request $request,$url){
        $menu = Menu::findOrFail($request->id);
        $subMenu = SubMenu::where(['fk_menu_id'=>$request->id,'status'=>1])->orderBy('serial_num','ASC')->get();
        return view('backend.home.subMenu',compact('subMenu','menu'));
    }
    public function subSubMenu(Request $request,$url,$slug){
        $subMenu = SubMenu::leftJoin('menu','fk_menu_id','menu.id')->select('sub_menu.*','menu.name as menu_name','menu.url as menu_url')->findOrFail($request->id);
        $subSubMenu = SubSubMenu::where(['fk_sub_menu_id'=>$request->id,'status'=>1])->orderBy('serial_num','ASC')->get();
        
        return view('backend.home.subSubMenu',compact('subMenu','subSubMenu'));
    }


}
