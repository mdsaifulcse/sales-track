<?php

namespace App\Http\Controllers;

use App\Models\CompanyVisit;
use App\Models\FollowUp;
use App\Models\MoneyAssignToEmp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\Models\UserInfo;
use DB,Auth,MyHelper,CommonWork;
use App\Models\SubMenu;
use App\Models\Menu;
use App\Models\SubSubMenu;


class DashboadController extends Controller
{
    protected $statusName=[];
    protected $totalVisit=[];
    protected $followUpStatus=[];
    protected $startDate='';
    protected $endDate='';
    protected $userId='';
    protected $followStatus='';

    public function dashboard(Request $request){

       $yearlyIncomeExpense=MoneyAssignToEmp::whereYear('assign_date',date('Y'))->whereNotIn('type',['Borrow','Repay'])
           ->select(DB::raw("DATE_FORMAT(assign_date, '%M-%Y') m"),DB::raw('sum(amount) as e'))
        ->orderBy('id','DESC')->groupBy('m')->get();

       $monthArr=[];

        if (count($yearlyIncomeExpense)>0){
            foreach ($yearlyIncomeExpense as $ky=>$investMonth){
                array_push($monthArr,date('n',strtotime($investMonth->m)));
            }

        }
        $mn=0;
        if (count($yearlyIncomeExpense)>0){
            $mn=date('n',strtotime($yearlyIncomeExpense[0]->m));
        }

        foreach ($yearlyIncomeExpense as $key=>$assignAmount){

            if($key==0) {
                        $k=1;
                    for ($mn;  $mn>=$k; $mn--) {

                    if (!in_array($mn, $monthArr)) {
                        $yearlyIncomeExpense[] = [
                            'm' => date('F',mktime(0, 0, 0, $mn)) . '-' . date('Y'),
                            'e' => 0,
                            'i' => 0,
                            'pl' => 0,
                        ];

                    } else {

                        $monthlyIncome = CompanyVisit::join('follow_ups', 'follow_ups.company_visit_id', 'company_visits.id')
                            ->where('company_visits.status', 11)
                            ->whereMonth('follow_ups.follow_date', date('m', strtotime($assignAmount->m)))
                            ->whereYear('follow_ups.follow_date', date('Y', strtotime($assignAmount->m)))->sum('company_visits.profit_value_tk');
                        $yearlyIncomeExpense[$key]['i'] = $monthlyIncome;
                        // profit loss calculation ------ pl=profit/loss
                        $yearlyIncomeExpense[$key]['pl'] = $yearlyIncomeExpense[$key]['i'] - $assignAmount->e;
                    }

                } // end for

            } // end if



        }



        $this->followStatus=CommonWork::status();
         $roleId =0;
         if($roleId==4){
            return  self::branchWiseDashboard($request);
         }

        $date = date("Y-m-d");

        $statuses=FollowUp::select('status')->where(['latest'=>1])->whereMonth('follow_date',date('m'))->orderBy('status','ASC')->groupBy('status')->pluck('status')->toArray();
        // get Status Name ----------
        $getStatusName=function($status){
            $followStatus=$this->followStatus;
          return  array_push($this->statusName,$followStatus[$status]);
        };

        array_map($getStatusName,$statuses);
        $statusNames=$this->statusName;

     // get Follow Up Status Count ----------
        $followUpCount=function($status){ //DB::raw('COUNT(status)AS statusNum') //select(DB::raw('COUNT(status)AS statusNum'))->
            $statusCount=FollowUp::where(['status'=>$status,'latest'=>1])->groupBy('company_visit_id')->whereMonth('follow_date',date('m'))->get()->count();
          return  array_push($this->followUpStatus,$statusCount);
        };

        array_map($followUpCount,$statuses);
        $followUpStatusCount=$this->followUpStatus;

     // get Total new Company visit ---------

        $totalVisit=FollowUp::select('company_visit_id')->where(['latest'=>1])
            ->groupBy('company_visit_id')->whereMonth('follow_date',date('m'))->get()->count();
        $totalVisitData=[];
        $totalVisitData=array_pad($totalVisitData,count($followUpStatusCount),$totalVisit);

        $moneyAssignUsers=User::join('money_assign_to_emps','money_assign_to_emps.user_id','users.id')
                                ->leftJoin('role_user','role_user.user_id','users.id')
                                ->leftJoin('roles','roles.id','role_user.role_id')
                                ->select('users.id',DB::raw('CONCAT(users.name, " ( ", roles.name, " )") as userName'))
                                ->where('users.status',1)->where('roles.slug','=','stuff')
                                ->orderBy('users.id','desc')->pluck('userName','users.id');

        $users=User::leftJoin('role_user','role_user.user_id','users.id')
            ->leftJoin('roles','roles.id','role_user.role_id')
            ->select('users.id',DB::raw('CONCAT(users.name, " ( ", roles.name, " )") as userName'))
            ->where('users.status',1)->where('roles.slug','=','stuff')
            ->orderBy('users.id','desc')->pluck('userName','users.id');


        $lcOpens=FollowUp::leftJoin('company_visits','follow_ups.company_visit_id','company_visits.id')
            ->select('company_visits.product_name','company_visits.visited_company','company_visits.status',
            'company_visits.quotation_value','company_visits.profit_value','company_visits.profit_percent','company_visits.currency_rate','company_visits.profit_value_tk','company_visits.id')
            ->where(['follow_ups.status'=>11,'latest'=>1])->whereMonth('follow_date',date('m'))->get();

        $followStatus=$this->followStatus;


        $profitData=FollowUp::leftJoin('company_visits','follow_ups.company_visit_id','company_visits.id')
            ->select(DB::raw('SUM(company_visits.profit_value)AS profitValue'), DB::raw('DATE_FORMAT(follow_date, "%b-%Y") as profitMonth'),'company_visits.id')
            ->where(['follow_ups.status'=>11,'latest'=>1])->whereYear('follow_date',date('Y'))
           ->orderBy('follow_ups.id','ASC')->groupBy('profitMonth')->get();//pluck('profitValue','profitMonth');

        $profitMonth=[];
        $profitValue=[];

        if (count($profitData)>0){
            foreach ($profitData as $profit){
                array_push($profitMonth,$profit->profitMonth);
                array_push($profitValue,$profit->profitValue);
            }
        }

        return view('backend.dashboard.index',compact('moneyAssignUsers','yearlyIncomeExpense','request','followStatus','statusNames',
            'totalVisitData','followUpStatusCount','profitMonth','profitValue','users','lcOpens'));
    }

    protected function searchProfitBarChartData(Request $request){


        $yearlyIncomeExpense=MoneyAssignToEmp::whereNotIn('type',['Borrow','Repay'])
            ->select(DB::raw("DATE_FORMAT(assign_date, '%M-%Y') m"),DB::raw('sum(amount) as e'))
            ->orderBy('id','DESC')->groupBy('m');

        if ($request->start_date!='' && $request->end_date!=''){
            $startDate=date('Y-m-d',strtotime($request->start_date));
            $endDate=date('Y-m-d',strtotime($request->end_date));

            $yearlyIncomeExpense=$yearlyIncomeExpense->whereBetween('assign_date',[$startDate,$endDate]);
        }else{
            $yearlyIncomeExpense=$yearlyIncomeExpense->whereYear('assign_date',date('Y'));
        }



        if (isset($request->user_id) && $request->user_id!=0){
            $yearlyIncomeExpense=$yearlyIncomeExpense->where('user_id',$request->user_id);
        }
        $yearlyIncomeExpense=$yearlyIncomeExpense->get();

        $monthArr=[];

        if (count($yearlyIncomeExpense)>0){
            foreach ($yearlyIncomeExpense as $ky=>$investMonth){
                array_push($monthArr,date('n',strtotime($investMonth->m)));
            }

        }
        $mn=0;
        if (count($yearlyIncomeExpense)>0){
            $mn=date('n',strtotime($yearlyIncomeExpense[0]->m));
        }

        foreach ($yearlyIncomeExpense as $key=>$assignAmount){


            if($key==0) {
                //for ($k = 1; $mn > $k; $k++) {
                $k=1;
                for ($mn;  $mn>=$k; $mn--) {

                    if (!in_array($mn, $monthArr)) {
                        $yearlyIncomeExpense[] = [
                            'm' => date('F',mktime(0, 0, 0, $mn)) . '-' . date('Y'),
                            'e' => 0,
                            'i' => 0,
                            'pl' => 0,
                        ];

                    } else {

                        $monthlyIncome=CompanyVisit::join('follow_ups','follow_ups.company_visit_id','company_visits.id')
                            ->where('company_visits.status',11)
                            ->whereMonth('follow_ups.follow_date',date('m',strtotime($assignAmount->m)))
                            ->whereYear('follow_ups.follow_date',date('Y',strtotime($assignAmount->m)))->sum('company_visits.profit_value_tk');
                        $yearlyIncomeExpense[$key]['i']=$monthlyIncome;

                        $yearlyIncomeExpense[$key]['pl']=$yearlyIncomeExpense[$key]['i']-$assignAmount->e;
                    }

                } // end for
            } // end if





//            if (isset($request->user_id) && $request->user_id!=0){
//                $monthlyIncome=CompanyVisit::join('follow_ups','follow_ups.company_visit_id','company_visits.id')
//                    ->where('company_visits.status',11)->where('company_visits.visited_by',$request->user_id)
//                    ->whereMonth('follow_ups.follow_date',date('m',strtotime($assignAmount->m)))
//                    ->whereYear('follow_ups.follow_date',date('Y',strtotime($assignAmount->m)))->sum('company_visits.profit_value_tk');
//                $yearlyIncomeExpense[$key]['i']=$monthlyIncome;
//                $yearlyIncomeExpense[$key]['pl']=$yearlyIncomeExpense[$key]['i']-$assignAmount->e;
//            }


        }

      //return $yearlyIncomeExpense;

        return response()->json(['yearlyIncomeExpense'=>$yearlyIncomeExpense]);
    }


    public function getStatusBarData(Request $request){

        if (isset($request->user_id)){
            $this->userId=$request->user_id;
        }

        if ($request->start_date){ $this->startDate=date('Y-m-d',strtotime($request->start_date));}
        if ($request->end_date){ $this->endDate=date('Y-m-d',strtotime($request->end_date));}

        $statuses=FollowUp::select('status')->where(['latest'=>1])->orderBy('status','ASC')->groupBy('status')
            ->whereBetween('follow_date',[$this->startDate,$this->endDate]);

        if ($this->userId!=0){$statuses=$statuses->where('follow_up_by',$request->user_id);}
        $statuses=$statuses->pluck('status')->toArray();

        // get Status Name ----------
        $getStatusName=function($status){
            $followStatus=CommonWork::status();
            return  array_push($this->statusName,$followStatus[$status]);
        };

        array_map($getStatusName,$statuses);
        $statusNames=$this->statusName;

        // get Follow Up Status Count ----------
        $followUpCount=function($status){ //DB::raw('COUNT(status)AS statusNum') //select(DB::raw('COUNT(status)AS statusNum'))->
            $statusCount=FollowUp::where(['status'=>$status,'latest'=>1])->groupBy('company_visit_id')
                ->whereBetween('follow_date',[$this->startDate,$this->endDate]);

            if ($this->userId!=0){$statusCount=$statusCount->where('follow_up_by',$this->userId);}
            $statusCount=$statusCount->get()->count();
            return  array_push($this->followUpStatus,$statusCount);
        };

        array_map($followUpCount,$statuses);
        $followUpStatusCount=$this->followUpStatus;

        // get Total new Company visit ---------

        $totalVisit=FollowUp::select('company_visit_id')->groupBy('company_visit_id')->where(['latest'=>1])
            ->whereBetween('follow_date',[$this->startDate,$this->endDate]);

        if ($this->userId!=0){$totalVisit=$totalVisit->where('follow_up_by',$this->userId);}
        $totalVisit=$totalVisit->get()->count();

        $totalVisitData=[];
        $totalVisitData=array_pad($totalVisitData,count($followUpStatusCount),$totalVisit);

        return response()->json(['statusNames'=>$statusNames,'totalVisitData'=>$totalVisitData,'followUpStatusCount'=>$followUpStatusCount]);
    }


    public function getCommissionChartData(Request $request){

        if (isset($request->user_id)){
            $this->userId=$request->user_id;
        }

        if ($request->start_date){ $this->startDate=date('Y-m-d',strtotime($request->start_date));}
        if ($request->end_date){ $this->endDate=date('Y-m-d',strtotime($request->end_date));}

        $profitData=FollowUp::leftJoin('company_visits','follow_ups.company_visit_id','company_visits.id')
            ->select(DB::raw('SUM(company_visits.profit_value)AS profitValue'), DB::raw('DATE_FORMAT(follow_date, "%b-%Y") as profitMonth'),'company_visits.id')
            ->where(['follow_ups.status'=>11,'latest'=>1])->whereBetween('follow_date',[$this->startDate,$this->endDate])
            ->orderBy('follow_ups.id','ASC')->groupBy('profitMonth');//->get();//pluck('profitValue','profitMonth');


        if ($request->user_id!=0){
            $profitData=$profitData->where('follow_up_by',$this->userId);
        }

        $profitData=$profitData->get();


        $profitMonth=[];
        $profitValue=[];

        if (count($profitData)>0){
            foreach ($profitData as $profit){
                array_push($profitMonth,$profit->profitMonth);
                array_push($profitValue,$profit->profitValue);
            }
        }

        return response()->json(['profitMonth'=>$profitMonth,'profitValue'=>$profitValue]);
    }


    public function filterCommissionProfit(Request $request){
        if (isset($request->user_id)){
            $this->userId=$request->user_id;
        }

        if ($request->start_date){ $this->startDate=date('Y-m-d',strtotime($request->start_date));}
        if ($request->end_date){ $this->endDate=date('Y-m-d',strtotime($request->end_date));}

        $lcOpens=FollowUp::leftJoin('company_visits','follow_ups.company_visit_id','company_visits.id')
            ->select('company_visits.product_name','company_visits.visited_company','company_visits.status',
                'company_visits.quotation_value','company_visits.profit_value','company_visits.profit_percent','company_visits.currency_rate','company_visits.profit_value_tk','company_visits.id')
            ->where(['follow_ups.status'=>11,'latest'=>1])->whereBetween('follow_date',[$this->startDate,$this->endDate]);

        if ($this->userId!=0){
            $lcOpens=$lcOpens->where('follow_up_by',$this->userId);
        }
        $lcOpens=$lcOpens->get();

        $followStatus=CommonWork::status();


        return view('backend.dashboard.commission-profit',compact('lcOpens','followStatus'));

        //return response()->json(['lcOpens'=>'$lcOpens']);
    }


    public function setCommissionAndProfit(Request $request){

        //return $request;

        if (!isset($request->id)){
            return redirect()->back()->with('error','Al least one Commission must to set');
        }

        //return $request;

        if (isset($request->id) && count($request->id)>0){
            foreach ($request->id as $key=>$id){
                $companyVisit=CompanyVisit::findOrFail($id);
                $companyVisit->update(
                    ['profit_percent'=>$request->profit_percent[$id],
                        'profit_value'=>$request->profit_value[$id],
                        'currency_rate'=>$request->currency_rate[$id],
                        'profit_value_tk'=>$request->profit_value_tk[$id],
                    ]
                );
            }
        }


        return redirect()->back()->with('success','Commission is Successfully Set');


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
        if(\MyHelper::userRole()->role=='stuff'){
          return  redirect('/stuff-dashboard');
        }

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
