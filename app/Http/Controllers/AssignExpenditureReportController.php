<?php

namespace App\Http\Controllers;

use App\Models\EmpExpenditure;
use App\Models\EmpMoneyTransaction;
use App\Models\MoneyAssignToEmp;
use App\Models\MonthlyRemaining;
use App\User;
use Illuminate\Http\Request;
use DB,Auth,CommonWork,MyHelper;
use Yajra\DataTables\DataTables;

class AssignExpenditureReportController extends Controller
{
    public function assignAndExpenditureReport($userId){
        $user=User::findOrFail($userId);
        $adminPurposes=CommonWork::AdminExpenditurePurpose();
        // ==============================
        $monthlyAssignAmount=MoneyAssignToEmp::whereMonth('assign_date',date('m'))
            ->where(['user_id'=>$userId,'type'=>'for_expenditure'])
            ->select('money_assign_to_emps.*')->orderBy('money_assign_to_emps.id','DESC')->get();

        $yearlyAssignAmount=MoneyAssignToEmp::whereYear('assign_date',date('Y'))
            ->where(['user_id'=>$userId,'type'=>'for_expenditure'])
            ->select(DB::raw('sum(amount) as montyLySum'),DB::raw('MONTH(assign_date) month'),DB::raw("DATE_FORMAT(assign_date, '%M-%Y') new_date"),'money_assign_to_emps.*')
            ->orderBy('month','DESC')->groupBy('month')->get();

        foreach ($yearlyAssignAmount as $yearlyAmount){
            // borrow from colleague --
            $monthLyBorrowTaka=EmpMoneyTransaction::join('emp_expenditures','emp_expenditures.id','emp_money_transactions.emp_expenditure_id')
                ->whereMonth('emp_expenditures.expenditure_date',$yearlyAmount->month)
                ->where(['emp_money_transactions.to_user_id'=>$userId,'transaction_type'=>2,
                    'emp_money_transactions.status'=>1])->sum('emp_money_transactions.amount');

            // borrow repay colleague --
            $monthLyBorrowRepayTaka=EmpMoneyTransaction::join('emp_expenditures','emp_expenditures.id','emp_money_transactions.emp_expenditure_id')
                ->whereMonth('emp_expenditures.expenditure_date',$yearlyAmount->month)
                ->where(['emp_money_transactions.from_user_id'=>$userId,'transaction_type'=>1,
                    'emp_money_transactions.status'=>1])->sum('emp_money_transactions.amount');


            // borrow give to colleague --------------
            $borrowGiveTaka=EmpMoneyTransaction::join('emp_expenditures','emp_expenditures.id','emp_money_transactions.emp_expenditure_id')
                ->whereMonth('emp_expenditures.expenditure_date',$yearlyAmount->month)
                ->where(['emp_money_transactions.from_user_id'=>$userId,'transaction_type'=>2,
                    'emp_money_transactions.status'=>1])->sum('emp_money_transactions.amount');

            // borrow return form colleague --------------
            $borrowReturnTaka=EmpMoneyTransaction::join('emp_expenditures','emp_expenditures.id','emp_money_transactions.emp_expenditure_id')
                ->whereMonth('emp_expenditures.expenditure_date',$yearlyAmount->month)
                ->where(['emp_money_transactions.to_user_id'=>$userId,'transaction_type'=>1,
                    'emp_money_transactions.status'=>1])->sum('emp_money_transactions.amount');

            $yearlyAmount->montyLySum+=$monthLyBorrowTaka;
//                if ($borrowReturnTaka>0){
//                    $yearlyAmount->montyLySum+=$borrowReturnTaka;
//                }
        }

        //Yearly expenditure ------
        $yearlyExpenditure=EmpExpenditure::whereYear('expenditure_date',date('Y'))
            ->where(['user_id'=>$userId,'status'=>1])->whereNotIn('purpose',[5,6])->sum('amount');

        // Yearly repay to colleague ------
        $yearlyOtherRepay=EmpMoneyTransaction::join('emp_expenditures','emp_expenditures.id','emp_money_transactions.emp_expenditure_id')
            ->whereYear('emp_expenditures.expenditure_date',date('Y'))
            ->where(['emp_money_transactions.from_user_id'=>$userId,'transaction_type'=>1,
                'emp_money_transactions.status'=>1])->sum('emp_money_transactions.amount');

        // yearly borrow give to colleague --------------
        $yearlyBorrowGiveTaka=EmpMoneyTransaction::join('emp_expenditures','emp_expenditures.id','emp_money_transactions.emp_expenditure_id')
            ->whereYear('emp_expenditures.expenditure_date',date('Y'))
            ->where(['emp_money_transactions.from_user_id'=>$userId,'transaction_type'=>2,
                'emp_money_transactions.status'=>1])->sum('emp_money_transactions.amount');

        // Yearly borrow return from colleague ------
        $yearlyBorrowReturn=EmpMoneyTransaction::join('emp_expenditures','emp_expenditures.id','emp_money_transactions.emp_expenditure_id')
            ->whereYear('emp_expenditures.expenditure_date',date('Y'))
            ->where(['emp_money_transactions.to_user_id'=>$userId,'transaction_type'=>1,
                'emp_money_transactions.status'=>1])->sum('emp_money_transactions.amount');
        // =========================

        $borrowAmount=MoneyAssignToEmp::whereMonth('assign_date',date('m')) //monthly borrow from office ------
        ->where(['user_id'=>$userId,'purpose'=>2,'type'=>'Borrow'])->sum('amount');

        $repayAmount=MoneyAssignToEmp::whereMonth('assign_date',date('m')) //monthly repay to office ------
        ->where(['user_id'=>$userId,'purpose'=>3,'type'=>'Repay'])->sum('amount');

        // monthly borrow from colleague ------
        $otherBorrow=EmpMoneyTransaction::join('emp_expenditures','emp_expenditures.id','emp_money_transactions.emp_expenditure_id')
            ->whereMonth('emp_expenditures.expenditure_date',date('m'))
            ->where(['emp_money_transactions.to_user_id'=>$userId,'transaction_type'=>2,
                'emp_money_transactions.status'=>1])->sum('emp_money_transactions.amount');

        // monthly repay to colleague ------
        $otherRepay=EmpMoneyTransaction::join('emp_expenditures','emp_expenditures.id','emp_money_transactions.emp_expenditure_id')
            ->whereMonth('emp_expenditures.expenditure_date',date('m'))
            ->where(['emp_money_transactions.from_user_id'=>$userId,'transaction_type'=>1,
                'emp_money_transactions.status'=>1])->sum('emp_money_transactions.amount');

        // monthly borrow give to colleague ------
        $borrowGive=EmpMoneyTransaction::join('emp_expenditures','emp_expenditures.id','emp_money_transactions.emp_expenditure_id')
            ->whereMonth('emp_expenditures.expenditure_date',date('m'))
            ->where(['emp_money_transactions.from_user_id'=>$userId,'transaction_type'=>2,
                'emp_money_transactions.status'=>1])->sum('emp_money_transactions.amount');

        // monthly borrow return from colleague ------
        $borrowReturn=EmpMoneyTransaction::join('emp_expenditures','emp_expenditures.id','emp_money_transactions.emp_expenditure_id')
            ->whereMonth('emp_expenditures.expenditure_date',date('m'))
            ->where(['emp_money_transactions.to_user_id'=>$userId,'transaction_type'=>1,
                'emp_money_transactions.status'=>1])->sum('emp_money_transactions.amount');

        $monthlyExpenditure=EmpExpenditure::whereMonth('expenditure_date',date('m')) //monthly expenditure ------
        ->where(['user_id'=>$userId,'status'=>1])->whereNotIn('purpose',[5,6])->sum('amount');

        $previousMonthRemaining=MonthlyRemaining::where(['user_id'=>$userId])
            ->whereYear('month_name',date('Y'))
            ->whereMonth('month_name',date('m')-1)
            ->value('remaining_amount');

        return view('backend.finance.report.assignExpenditureModal',compact('user','adminPurposes','yearlyAssignAmount','yearlyBorrowGiveTaka',
            'yearlyBorrowReturn','yearlyExpenditure','yearlyOtherRepay','monthlyAssignAmount',
            'borrowAmount','repayAmount','otherBorrow','otherRepay','borrowGive','borrowReturn','monthlyExpenditure','previousMonthRemaining'));
    }



    public function AllEmpExpenditure(){
        $users=User::where(['status'=>1])->whereNotIn('id',[1,Auth::user()->id])->orderBy('id','DESC')->pluck('name','id');
        $purpose=CommonWork::expenditurePurpose();

        return view('backend.finance.report.emp-expenditure',compact('users','purpose'));
    }

    public function AllEmpExpenditureList(Request $request)
    {
        $expenditure=EmpExpenditure::leftJoin('users','users.id','emp_expenditures.user_id')
            ->select('users.name','users.mobile','users.email','emp_expenditures.*')
            ->orderBy('emp_expenditures.id','DESC');

        if (isset($request->user_id) && $request->user_id!=''){
            $expenditure=$expenditure->where('emp_expenditures.user_id',$request->user_id);
        }

        if (isset($request->purpose) && $request->purpose!=''){
            $expenditure=$expenditure->where('emp_expenditures.purpose',$request->purpose);
        }

        if (isset($request->purpose) && $request->purpose!=''){
            $expenditure=$expenditure->where('emp_expenditures.purpose',$request->purpose);
        }


        if (isset($request->start_date) && $request->start_date!=null && isset($request->end_date) && $request->end_date!=null){
            $startDate=date('Y-m-d',strtotime($request->start_date));
            $endDate=date('Y-m-d',strtotime($request->end_date));

            $expenditure=$expenditure->whereBetween('emp_expenditures.expenditure_date',[$startDate, $endDate]);

        }else if (isset($request->start_date) && $request->start_date!=null){
            $expenditureDate=date('Y-m-d',strtotime($request->start_date));
            $expenditure=$expenditure->whereDate('emp_expenditures.expenditure_date', '>=', $expenditureDate);

        }else if (isset($request->end_date) && $request->end_date!=null){
            $expenditureDate=date('Y-m-d',strtotime($request->end_date));
            $expenditure=$expenditure->where('emp_expenditures.expenditure_date','<',$expenditureDate);
        }



        return DataTables::of($expenditure)
            ->addIndexColumn()
            ->addColumn('DT_RowIndex','')
            ->addColumn('Date','<?php echo date(\'d-M-Y\',strtotime($expenditure_date))?>')
            ->addColumn('purpose',
                '@if($purpose==1)
                <span class="btn btn-info btn-xs">Transport Cost </span>
                @elseif($purpose==2)
                <span class="btn btn-info btn-xs">Food Cost </span>
                @elseif($purpose==3)
                <span class="btn btn-info btn-xs">Phone Bill </span>
                @elseif($purpose==4)
                <span class="btn btn-info btn-xs">Accommodation </span>
                @elseif($purpose==5)
                <span class="btn btn-info btn-xs">Borrow Repay </span>
                @elseif($purpose==6)
                <span class="btn btn-info btn-xs">Borrow(Give </span>
                @elseif($purpose==7)
                <span class="btn btn-info btn-xs">Miscellaneous </span>
                @elseif($purpose==8)
                <span class="btn btn-info btn-xs">Foreigner Breakfast </span>
                @elseif($purpose==9)
                <span class="btn btn-info btn-xs">Foreigner Launch </span>
                @elseif($purpose==8)
                <span class="btn btn-info btn-xs">Foreigner Dinner </span>
                @endif')
            ->addColumn('Status',
                '@if($status==0)
                <span class="btn btn-warning btn-xs">Pending </span>
                @elseif($status==1)
                <span class="btn btn-info btn-xs">Approve</span>
                @endif')
            ->addColumn('action','
                {{Form::open(array(\'route\'=>[\'expenditure.destroy\',$id],\'method\'=>\'DELETE\',\'class\'=>\'deleteForm\',\'id\'=>"deleteForm$id"))}}
                   
                    <button type="button" class="btn btn-danger btn-xs" onclick=\'return deleteConfirm("deleteForm{{$id}}")\'><i class="fa fa-trash"></i></button>
                {{ Form::close()}}
            ')->rawColumns(['Date','purpose','Status','action'])->toJson();
    }


}
