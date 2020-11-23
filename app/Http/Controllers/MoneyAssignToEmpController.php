<?php

namespace App\Http\Controllers;

use App\Models\BudgetAllocation;
use App\Models\MoneyAssignToEmp;
use App\User;
use Illuminate\Http\Request;
use Validator,DB,Auth,CommonWork,MyHelper;
use Yajra\DataTables\DataTables;

class MoneyAssignToEmpController extends Controller
{

    public function index()
    {
        // budget --------
        $yearlyBudget=BudgetAllocation::whereYear('allocation_date',date('Y'))
            ->select(DB::raw('sum(amount) as montyLySum'),DB::raw('MONTH(allocation_date) month'),DB::raw("DATE_FORMAT(allocation_date, '%M-%Y') new_date"))
            ->orderBy('month','DESC')->groupBy('month')->get();

         $monthlyBudget=BudgetAllocation::whereMonth('allocation_date',date('m')) //monthly borrow from office ------
        ->where(['status'=>1])->sum('amount');

         // previous month ----
         $previousMonthlyBudget=BudgetAllocation::whereMonth('allocation_date',date('m')-1) //monthly borrow from office ------
        ->where(['status'=>1])->sum('amount');

        $previousMonthlyExpenseAmount=MoneyAssignToEmp::whereMonth('assign_date',date('m')-1)
            ->where('type','!=','Repay')->where('status',1)->sum('amount');

        $previousBorrowReturnFromEmp=MoneyAssignToEmp::whereMonth('assign_date',date('m')-1)
            ->where('type','=','Repay')->where('status',1)->sum('amount');

         // expenses --------

        $monthlyExpenseAmount=MoneyAssignToEmp::whereMonth('assign_date',date('m'))
            ->where('type','!=','Repay')->where('status',1)->sum('amount');

        $borrowReturnFromEmp=MoneyAssignToEmp::whereMonth('assign_date',date('m'))
            ->where('type','=','Repay')->where('status',1)->sum('amount');

//        $yearlyAssignAmount=MoneyAssignToEmp::whereYear('assign_date',date('Y'))
//            ->where('type','!=','Repay')->select(DB::raw('sum(amount) as monthLySum'),DB::raw('MONTH(assign_date) month'),DB::raw("DATE_FORMAT(assign_date, '%M-%Y') new_date"))
//            ->orderBy('month','DESC')->groupBy('month')->get();

        foreach ($yearlyBudget as $key=>$yearlyAmount){
            $monthlyWiseBudget=BudgetAllocation::whereMonth('allocation_date',$yearlyAmount->month)
            ->where(['status'=>1])->sum('amount');
            $yearlyBudget[$key]['monthlyWiseBudget']=$monthlyWiseBudget;

            $monthlyWiseExpenseAmount=MoneyAssignToEmp::whereMonth('assign_date',$yearlyAmount->month)
                ->where('type','!=','Repay')->where('status',1)->sum('amount');
            $yearlyBudget[$key]['monthlyWiseExpenseAmount']=$monthlyWiseExpenseAmount;

            $monthlyWiseBorrowReturnFromEmp=MoneyAssignToEmp::whereMonth('assign_date',$yearlyAmount->month)
                ->where('type','=','Repay')->where('status',1)->sum('amount');
            $yearlyBudget[$key]['monthlyWiseBorrowReturnFromEmp']=$monthlyWiseBorrowReturnFromEmp;
        }
        //return $yearlyBudget;


        $moneyAssignedUsers=User::join('money_assign_to_emps','money_assign_to_emps.user_id','users.id')
           ->select('users.name','users.mobile','users.id')
        ->where(['users.status'=>1])->whereNotIn('users.id',[1,9])->orderBy('users.id','DESC')
            ->groupBy('money_assign_to_emps.user_id')->get();

        $users=User::where(['status'=>1])->where('id','!=',1)->orderBy('id','DESC')->pluck('name','id');
        $adminPurposes=CommonWork::AdminExpenditurePurpose();
        return view('backend.finance.money-assign.index',compact('yearlyBudget','monthlyBudget','monthlyExpenseAmount','moneyAssignedUsers',
            'borrowReturnFromEmp','users','adminPurposes','previousMonthlyBudget','previousMonthlyExpenseAmount','previousBorrowReturnFromEmp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $moneyAssignData=MoneyAssignToEmp::leftJoin('users','users.id','money_assign_to_emps.user_id')
            ->select('users.name','money_assign_to_emps.*')
            ->orderBy('money_assign_to_emps.id','DESC');

        if (isset($request->user_id) && $request->user_id!=''){
            $moneyAssignData=$moneyAssignData->where('money_assign_to_emps.user_id',$request->user_id);
        }
        if (isset($request->purpose) && $request->purpose!=''){
            $moneyAssignData=$moneyAssignData->where('money_assign_to_emps.purpose',$request->purpose);
        }

        if (isset($request->start_date) && $request->start_date!=null && isset($request->end_date) && $request->end_date!=null){
            $startDate=date('Y-m-d',strtotime($request->start_date));
            $endDate=date('Y-m-d',strtotime($request->end_date));

            $moneyAssignData=$moneyAssignData->whereBetween('money_assign_to_emps.assign_date',[$startDate, $endDate]);

        }else if (isset($request->start_date) && $request->start_date!=null){
            $assignDate=date('Y-m-d',strtotime($request->start_date));
            $moneyAssignData=$moneyAssignData->whereDate('money_assign_to_emps.assign_date', '>=', $assignDate);

        }else if (isset($request->end_date) && $request->end_date!=null){
            $assignDate=date('Y-m-d',strtotime($request->end_date));
            $moneyAssignData=$moneyAssignData->where('money_assign_to_emps.assign_date','<',$assignDate);
        }


        return DataTables::of($moneyAssignData)
            ->addIndexColumn()
            ->addColumn('DT_RowIndex','')
            ->addColumn('Date','<?php echo date(\'d-M-Y\',strtotime($assign_date))?>')
            ->addColumn('Purpose','
                @if($purpose==1)
                <span class="btn btn-info btn-xs">Salary </span>
                @elseif($purpose==2)
                <span class="btn btn-info btn-xs">Borrow from Office </span>
                @elseif($purpose==3)
                <span class="btn btn-info btn-xs">Repay amount from borrow amount </span>
                @elseif($purpose==4)
                <span class="btn btn-info btn-xs">Mobile Bill </span>
                @elseif($purpose==5)
                <span class="btn btn-info btn-xs">Monthly Expenditure </span>
                @elseif($purpose==6)
                <span class="btn btn-info btn-xs">Foreigner Visit </span>
                @elseif($purpose==7)
                <span class="btn btn-info btn-xs">Foreigner Breakfast </span>
                @elseif($purpose==8)
                <span class="btn btn-info btn-xs">Foreigner Launch </span>
                @elseif($purpose==9)
                <span class="btn btn-info btn-xs">Foreigner Dinner </span>
                @elseif($purpose==10)
                <span class="btn btn-info btn-xs">Driver Salary </span>
                @elseif($purpose==11)
                <span class="btn btn-info btn-xs">Car Maintenance </span>
                @elseif($purpose==12)
                <span class="btn btn-info btn-xs">Car Oil/Gasoline </span>
                @elseif($purpose==13)
                <span class="btn btn-info btn-xs">Driver Over Time </span>
                @elseif($purpose==14)
                <span class="btn btn-info btn-xs">Driver Launch /Dinner </span>
                @elseif($purpose==15)
                <span class="btn btn-info btn-xs">Launch/ Dinner Self </span>
                @elseif($purpose==16)
                <span class="btn btn-info btn-xs">Transport Self </span>
                @elseif($purpose==17)
                <span class="btn btn-info btn-xs">Miscellaneous </span>
                @endif
            ')
            ->addColumn('Status','@if($status==1)
                <span class="btn btn-success btn-xs"><i class="fa fa-check"></i> Active </span>
                @elseif($status==0)
                <span class="btn btn-warning btn-xs"><i class="fa fa-warning"></i> Inactive </span>
                @endif')
            ->addColumn('action','
                {{Form::open(array(\'route\'=>[\'money-assign.destroy\',$id],\'method\'=>\'DELETE\',\'class\'=>\'deleteForm\',\'id\'=>"deleteForm$id"))}}
                    <a href="javascript:void(0)" onclick="editAssignMoney({{$id}})" title="Click here to edit this" class="btn btn-xs btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    <button type="button" class="btn btn-danger btn-xs" onclick=\'return deleteConfirm("deleteForm{{$id}}")\'><i class="fa fa-trash"></i></button>
                {{ Form::close()}}
            ')->rawColumns(['Date','Purpose','Status','action'])->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'user_id'=> 'required|exists:users,id',
            'assign_date'=> 'required|date',
            'purpose'=> 'required|max:250',
            'amount'=> 'required|max:99999999999'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        try{
            if ($request->assign_date!=''){
                $input['assign_date']=date('Y-m-d',strtotime($request->assign_date));
            }

            if ($request->hasFile('docs_img')){
                $input['docs_img']=MyHelper::photoUpload($request->file('docs_img'),'images/money-assign/receipt/',300);
            }

            $input['created_by']=Auth::user()->id;

            if ($request->purpose==1){
                $input['type']='Salary';
            }elseif ($request->purpose==2){
                $input['type']='Borrow';
            }elseif ($request->purpose==3){
                $input['type']='Repay';
            }

            MoneyAssignToEmp::create($input);

            $bug = 0;
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        if($bug==0){
            return redirect()->back()->with('success','Money Successfully Assign');
        }else{
            return redirect()->back()->with('error',$bug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BudgetAllocation  $budgetAllocation
     * @return \Illuminate\Http\Response
     */
    public function show(BudgetAllocation $budgetAllocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BudgetAllocation  $budgetAllocation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $assignMoney=MoneyAssignToEmp::findOrFail($id);
        $users=User::where(['status'=>1])->where('id','!=',1)->orderBy('id','DESC')->pluck('name','id');
        $adminPurposes=CommonWork::AdminExpenditurePurpose();
        return view('backend.finance.money-assign.editAssignMoneyModal',compact('users','adminPurposes','assignMoney'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BudgetAllocation  $budgetAllocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'user_id'=> 'required|exists:users,id',
            'assign_date'=> 'required|date',
            'purpose'=> 'required|max:250',
            'amount'=> 'required|max:99999999999',
            'status'=> 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $moneyAssign=MoneyAssignToEmp::findOrFail($id);
        try{

            if ($request->assign_date!=''){
                $input['assign_date']=date('Y-m-d',strtotime($request->assign_date));
            }

            if ($request->hasFile('docs_img')){
                if ($moneyAssign->docs_img!='' && file_exists($moneyAssign->docs_img)){
                    unlink($moneyAssign->docs_img);
                }

                $input['docs_img']=MyHelper::photoUpload($request->file('docs_img'),'images/money-assign/receipt/',300);
            }

            if ($request->purpose==1){
                $input['type']='Salary';
            }elseif ($request->purpose==2){
                $input['type']='Borrow';
            }elseif ($request->purpose==3){
                $input['type']='Repay';
            }

            $input['updated_by']=Auth::user()->id;
            $moneyAssign->update($input);
            $bug=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }
        if($bug==0){
            return redirect()->back()->with('success','Money Assign Successfully Update');
        }else{
            return redirect()->back()->with('error','Something Error Found ! ');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BudgetAllocation  $budgetAllocation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $moneyAssign=MoneyAssignToEmp::findOrFail($id);

            if ($moneyAssign->docs_img!='' && file_exists($moneyAssign->docs_img)){
                unlink($moneyAssign->docs_img);
            }

            $moneyAssign->delete();
            $bug=0;
            $error=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            $error=$e->errorInfo[2];
        }
        if($bug==0){
            return redirect()->back()->with('success','Money Assign Successfully Deleted!');
        }elseif($bug==1451){
            return redirect()->back()->with('error','This Data is Used anywhere ! ');
        }
    }

}
