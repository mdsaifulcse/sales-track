<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\EmpExpenditure;
use App\Models\EmpMoneyTransaction;
use App\Models\MoneyAssignToEmp;
use App\Models\MonthlyRemaining;
use App\User;
use Illuminate\Http\Request;
use Validator,DB,Auth,CommonWork,MyHelper;
use Yajra\DataTables\DataTables;

class EmpExpenditureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users=User::where(['status'=>1])->whereNotIn('id',[1,Auth::user()->id])->orderBy('id','DESC')->pluck('name','id');
        $purpose=CommonWork::expenditurePurpose();
        $adminPurposes=CommonWork::AdminExpenditurePurpose();

        // ==============================
        $monthlyAssignAmount=MoneyAssignToEmp::whereMonth('assign_date',date('m'))
            ->where(['user_id'=>Auth::user()->id,'type'=>'for_expenditure'])
           ->select('money_assign_to_emps.*')->orderBy('money_assign_to_emps.id','DESC')->get();

        $yearlyAssignAmount=MoneyAssignToEmp::whereYear('assign_date',date('Y'))
            ->where(['user_id'=>Auth::user()->id,'type'=>'for_expenditure'])
            ->select(DB::raw('sum(amount) as montyLySum'),DB::raw('MONTH(assign_date) month'),DB::raw("DATE_FORMAT(assign_date, '%M-%Y') new_date"),'money_assign_to_emps.*')
            ->orderBy('month','DESC')->groupBy('month')->get();

            foreach ($yearlyAssignAmount as $yearlyAmount){
                // borrow from colleague --
                $monthLyBorrowTaka=EmpMoneyTransaction::join('emp_expenditures','emp_expenditures.id','emp_money_transactions.emp_expenditure_id')
                    ->whereMonth('emp_expenditures.expenditure_date',$yearlyAmount->month)
                    ->where(['emp_money_transactions.to_user_id'=>Auth::user()->id,'transaction_type'=>2,
                        'emp_money_transactions.status'=>1])->sum('emp_money_transactions.amount');

                // borrow repay colleague --
                $monthLyBorrowRepayTaka=EmpMoneyTransaction::join('emp_expenditures','emp_expenditures.id','emp_money_transactions.emp_expenditure_id')
                    ->whereMonth('emp_expenditures.expenditure_date',$yearlyAmount->month)
                    ->where(['emp_money_transactions.from_user_id'=>Auth::user()->id,'transaction_type'=>1,
                        'emp_money_transactions.status'=>1])->sum('emp_money_transactions.amount');


                // borrow give to colleague --------------
                $borrowGiveTaka=EmpMoneyTransaction::join('emp_expenditures','emp_expenditures.id','emp_money_transactions.emp_expenditure_id')
                    ->whereMonth('emp_expenditures.expenditure_date',$yearlyAmount->month)
                    ->where(['emp_money_transactions.from_user_id'=>Auth::user()->id,'transaction_type'=>2,
                        'emp_money_transactions.status'=>1])->sum('emp_money_transactions.amount');

                // borrow return form colleague --------------
                $borrowReturnTaka=EmpMoneyTransaction::join('emp_expenditures','emp_expenditures.id','emp_money_transactions.emp_expenditure_id')
                    ->whereMonth('emp_expenditures.expenditure_date',$yearlyAmount->month)
                    ->where(['emp_money_transactions.to_user_id'=>Auth::user()->id,'transaction_type'=>1,
                        'emp_money_transactions.status'=>1])->sum('emp_money_transactions.amount');

                $yearlyAmount->montyLySum+=$monthLyBorrowTaka;
//                if ($borrowReturnTaka>0){
//                    $yearlyAmount->montyLySum+=$borrowReturnTaka;
//                }
            }

        //Yearly expenditure ------
        $yearlyExpenditure=EmpExpenditure::whereYear('expenditure_date',date('Y'))
        ->where(['user_id'=>Auth::user()->id,'status'=>1])->whereNotIn('purpose',[5,6])->sum('amount');

        // Yearly repay to colleague ------
        $yearlyOtherRepay=EmpMoneyTransaction::join('emp_expenditures','emp_expenditures.id','emp_money_transactions.emp_expenditure_id')
            ->whereYear('emp_expenditures.expenditure_date',date('Y'))
            ->where(['emp_money_transactions.from_user_id'=>Auth::user()->id,'transaction_type'=>1,
                'emp_money_transactions.status'=>1])->sum('emp_money_transactions.amount');

        // yearly borrow give to colleague --------------
        $yearlyBorrowGiveTaka=EmpMoneyTransaction::join('emp_expenditures','emp_expenditures.id','emp_money_transactions.emp_expenditure_id')
            ->whereYear('emp_expenditures.expenditure_date',date('Y'))
            ->where(['emp_money_transactions.from_user_id'=>Auth::user()->id,'transaction_type'=>2,
                'emp_money_transactions.status'=>1])->sum('emp_money_transactions.amount');

        // Yearly borrow return from colleague ------
        $yearlyBorrowReturn=EmpMoneyTransaction::join('emp_expenditures','emp_expenditures.id','emp_money_transactions.emp_expenditure_id')
            ->whereYear('emp_expenditures.expenditure_date',date('Y'))
            ->where(['emp_money_transactions.to_user_id'=>Auth::user()->id,'transaction_type'=>1,
                'emp_money_transactions.status'=>1])->sum('emp_money_transactions.amount');
        // =========================

        $borrowAmount=MoneyAssignToEmp::whereMonth('assign_date',date('m')) //monthly borrow from office ------
            ->where(['user_id'=>Auth::user()->id,'purpose'=>2,'type'=>'Borrow'])->sum('amount');

        $repayAmount=MoneyAssignToEmp::whereMonth('assign_date',date('m')) //monthly repay to office ------
            ->where(['user_id'=>Auth::user()->id,'purpose'=>3,'type'=>'Repay'])->sum('amount');

        // monthly borrow from colleague ------
        $otherBorrow=EmpMoneyTransaction::join('emp_expenditures','emp_expenditures.id','emp_money_transactions.emp_expenditure_id')
            ->whereMonth('emp_expenditures.expenditure_date',date('m'))
            ->where(['emp_money_transactions.to_user_id'=>Auth::user()->id,'transaction_type'=>2,
                'emp_money_transactions.status'=>1])->sum('emp_money_transactions.amount');

        // monthly repay to colleague ------
        $otherRepay=EmpMoneyTransaction::join('emp_expenditures','emp_expenditures.id','emp_money_transactions.emp_expenditure_id')
            ->whereMonth('emp_expenditures.expenditure_date',date('m'))
            ->where(['emp_money_transactions.from_user_id'=>Auth::user()->id,'transaction_type'=>1,
                'emp_money_transactions.status'=>1])->sum('emp_money_transactions.amount');

        // monthly borrow give to colleague ------
        $borrowGive=EmpMoneyTransaction::join('emp_expenditures','emp_expenditures.id','emp_money_transactions.emp_expenditure_id')
            ->whereMonth('emp_expenditures.expenditure_date',date('m'))
            ->where(['emp_money_transactions.from_user_id'=>Auth::user()->id,'transaction_type'=>2,
                'emp_money_transactions.status'=>1])->sum('emp_money_transactions.amount');

        // monthly borrow return from colleague ------
        $borrowReturn=EmpMoneyTransaction::join('emp_expenditures','emp_expenditures.id','emp_money_transactions.emp_expenditure_id')
            ->whereMonth('emp_expenditures.expenditure_date',date('m'))
            ->where(['emp_money_transactions.to_user_id'=>Auth::user()->id,'transaction_type'=>1,
                'emp_money_transactions.status'=>1])->sum('emp_money_transactions.amount');

        $monthlyExpenditure=EmpExpenditure::whereMonth('expenditure_date',date('m')) //monthly expenditure ------
        ->where(['user_id'=>Auth::user()->id])->whereIn('status',[0,1])->whereNotIn('purpose',[5,6])->sum('amount');

        $previousMonthRemaining=MonthlyRemaining::where(['user_id'=>Auth::user()->id])
            ->whereYear('month_name',date('Y'))
            ->whereMonth('month_name',date('m')-1)
            ->value('remaining_amount');

        return view('backend.finance.expenditure.index',compact('users','purpose','yearlyAssignAmount','yearlyBorrowGiveTaka','yearlyBorrowReturn',
            'yearlyExpenditure','yearlyOtherRepay','monthlyAssignAmount',
            'adminPurposes','borrowAmount','repayAmount','otherBorrow','otherRepay','borrowGive','borrowReturn','monthlyExpenditure','previousMonthRemaining'));
    }

    public function getRepayToUser($userId=null){

        $rePayUsers=EmpMoneyTransaction::leftJoin('emp_expenditures','emp_money_transactions.emp_expenditure_id','emp_expenditures.id')
            ->leftJoin('users','emp_money_transactions.to_user_id','users.id')
            ->leftJoin('users as rePayToUser','emp_money_transactions.from_user_id','rePayToUser.id')
            ->where(['emp_money_transactions.to_user_id'=>Auth::user()->id,'transaction_type'=>2,'emp_money_transactions.status'=>1,
                'emp_money_transactions.transaction_status'=>1])
            ->select(DB::raw("CONCAT(rePayToUser.name,' ( tk.',round(emp_money_transactions.amount),' )') AS userName"), 'emp_money_transactions.id')
            ->whereYear('emp_expenditures.expenditure_date',date('Y'))->pluck('userName','emp_money_transactions.id');
        //  into rePayUsers array id is emp_money_transactions.id

        return view('backend.finance.expenditure.repay-to-user',compact('rePayUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $expenditure=EmpExpenditure::leftJoin('users','users.id','emp_expenditures.user_id')
            ->leftJoin('emp_money_transactions','emp_expenditures.id','emp_money_transactions.emp_expenditure_id')
            ->select('users.name','users.mobile','users.email','emp_money_transactions.status as trxStatus','emp_expenditures.*')
            ->where('user_id',Auth::user()->id)->orderBy('emp_expenditures.id','DESC');

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
@if($trxStatus!=1)
                {{Form::open(array(\'route\'=>[\'expenditure.destroy\',$id],\'method\'=>\'DELETE\',\'class\'=>\'deleteForm\',\'id\'=>"deleteForm$id"))}}
                
                    
                    
                    <button type="button" class="btn btn-danger btn-xs" onclick=\'return deleteConfirm("deleteForm{{$id}}")\' title="Click here to edit this"><i class="fa fa-trash"></i></button>
                {{ Form::close()}}
                @endif
            ')->rawColumns(['Date','purpose','Status','action'])->toJson();
    }

//<a href="javascript:void(0)" onclick="editExpenditure({{$id}})" title="Click here to edit this" class="btn btn-xs btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

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
            //'user_id'=> 'required|exists:users,id',
            'expenditure_date'=> 'required|date',
            'purpose'=> 'required|max:250',
            'amount'=> 'required|max:99999999999',
            "phone_bill_trxid" => "required_if:purpose,==,3",
            "miscellaneous" => "required_if:purpose,==,7",
            "hotel_name" => "required_if:purpose,==,4",
            "no_of_night" => "required_if:purpose,==,4",
            "facilities" => "required_if:purpose,==,4",
            "contact_name" => "required_if:purpose,==,4",
            "contact_phone" => "required_if:purpose,==,4",
            "give_to_user_id" => "required_if:purpose,==,6",
            "emp_money_transaction_id" => "required_if:purpose,==,5",
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $monthlyAssignAmount=MoneyAssignToEmp::whereMonth('assign_date',date('m'))
            ->where(['user_id'=>Auth::user()->id,'type'=>'for_expenditure','status'=>1])->sum('amount');

        if ($monthlyAssignAmount==0){ // expense not allowed without monthly money assign----
            return redirect()->back()->with('error','Currently you have\'t assign amount! pls contact with your admin');
        }

        // can't give or repay over monthly assign amount ----
        if (($request->purpose==6 || $request->purpose==5) && $request->amount>$monthlyAssignAmount){
            return redirect()->back()->with('error','You can not exceed the limit amount');
        }

        DB::beginTransaction();
        try{


            if ($request->expenditure_date!=''){
                $expenditureMonth=date('m',strtotime($request->expenditure_date));

                if ($expenditureMonth!=date('m')){
                    return redirect()->back()->with('error','Expenditure month must be current month');
                }

                $input['expenditure_date']=date('Y-m-d',strtotime($request->expenditure_date));
            }

            if ($request->hasFile('docs_img')){
                $input['docs_img']=MyHelper::photoUpload($request->file('docs_img'),'images/docs-image/',300);
            }

            if ($request->user_id==''){
                $input['user_id']=Auth::user()->id;
            }
            $input['created_by']=Auth::user()->id;

            if ($request->purpose==5 || $request->purpose==6){
                 // calculate monthly remaining amount ---

            $monthlyRemaining=MonthlyRemaining::where(['user_id'=>Auth::user()->id])
                ->whereYear('month_name',date('Y',strtotime($request->expenditure_date)))
                ->whereMonth('month_name',date('m',strtotime($request->expenditure_date)))
                ->first();

                if (!empty($monthlyRemaining)){
                    $monthlyRemaining->update(['remaining_amount'=>$request->remaining_amount]);
                }else{
                    MonthlyRemaining::create([
                        'user_id'=>Auth::user()->id,
                        'month_name'=>$input['expenditure_date'],
                        'remaining_amount'=>$request->remaining_amount
                        ]);
                }
            }

            $expenditure=EmpExpenditure::create($input);

            if ($request->hotel_name!='' && $request->no_of_night!=''){
                $input['emp_expenditure_id']=$expenditure->id;
                Accommodation::create($input);
            }

            // insert into emp_money_transactions if purpose is 5 or 6


            if ($request->purpose==5){  // Borrow repay to colleague ---------
                $moneyTransaction=EmpMoneyTransaction::findOrFail($request->emp_money_transaction_id);

                if ($request->amount!=$moneyTransaction->amount){
                    return redirect()->back()->with('error','Repay amount must be '.$moneyTransaction->amount);
                }

                $moneyTransaction->update(['transaction_status'=>1]);

                $input['emp_expenditure_id']=$expenditure->id;
                $input['transaction_type']=1;
                $input['from_user_id']=Auth::user()->id;
                $input['to_user_id']=$moneyTransaction->from_user_id;
                $input['status']=0; // 0=Pending, 1=Approved;
                EmpMoneyTransaction::create($input);
            }

            if ($request->purpose==6){ // Borrow give to to colleague ---------
                $input['emp_expenditure_id']=$expenditure->id;
                $input['transaction_type']=2;
                $input['from_user_id']=Auth::user()->id;
                $input['to_user_id']=$request->give_to_user_id;
                $input['status']=0; // 0=Pending, 1=Approved;
                EmpMoneyTransaction::create($input);
            }

            DB::commit();
            $bug=0;
        }catch(Exception $e){
            DB::rollback();
            $bug=$e->errorInfo[1];
            $bug2=$e->errorInfo[1];
        }
        if($bug==0){
            if ($request->purpose==5){
                return redirect()->back()->with('error','Your borrow repay waiting for review');
            }elseif($request->purpose==6){
                return redirect()->back()->with('error','Your borrow give waiting for review');
            }

            return redirect()->back()->with('success','Expenditure Details Successfully Save');
        }else{
            return redirect()->back()->with('error',$bug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmpExpenditure  $empExpenditure
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {

        if (\MyHelper::userRole()->role=='stuff'){
            return redirect('/expenditure')->with('error','Your are not permitted to perform this action');
        }

        $empExpenditure=EmpExpenditure::find($id);
        if (empty($empExpenditure)){
            return redirect()->back()->with('error','Trx request may be deleted');
        }
        $data=EmpMoneyTransaction::where('emp_expenditure_id',$id)->first();

        if (date('m',strtotime($empExpenditure->expenditure_date))!=date('m')){
            return redirect()->back()->with('Trx request month and current month must be same, Pls delete this request and regenerate the request','');
        }


        DB::beginTransaction();
        try{
            $input=['updated_by'=>Auth::user()->id];
            if ($request->status==1){
                $input['status']=1;
            }elseif ($request->status==2){
                $input['status']=2;
            }else{
                $input['status']=0;
            }



            // add amount with remaining amount
            if ($request->status==1 && $data->status==0){ //$data->status== current status ------

                $monthlyRemaining=MonthlyRemaining::where(['user_id'=>$empExpenditure->user_id])
                    ->whereYear('month_name',date('Y',strtotime($empExpenditure->expenditure_date)))
                    ->whereMonth('month_name',date('m',strtotime($empExpenditure->expenditure_date)))
                    ->first();

                if (!empty($monthlyRemaining)){
                    $monthlyRemaining->update(['remaining_amount'=>$monthlyRemaining->remaining_amount-$empExpenditure->amount]);
                }



                $toSenderMonthlyRemaining=MonthlyRemaining::where(['user_id'=>$data->to_user_id])
                    ->whereYear('month_name',date('Y',strtotime($empExpenditure->expenditure_date)))
                    ->whereMonth('month_name',date('m',strtotime($empExpenditure->expenditure_date))-1)
                    ->first();

                if (!empty($toSenderMonthlyRemaining)){
                    $toSenderMonthlyRemaining->update(['remaining_amount'=>$toSenderMonthlyRemaining->remaining_amount+$empExpenditure->amount]);
                }else{
                    MonthlyRemaining::create([
                        'user_id'=>$data->to_user_id,
                        'month_name'=>date('Y-m-d',strtotime($empExpenditure->expenditure_date)),
                        'remaining_amount'=>$empExpenditure->amount
                    ]);
                }
            }
//            elseif(($request->status==2 || $request->status==1) && ($data->status==1 || $data->status==0)){
//
//                $monthlyRemaining=MonthlyRemaining::where(['user_id'=>$empExpenditure->user_id])
//                    ->whereYear('month_name',date('Y',strtotime($empExpenditure->expenditure_date)))
//                    ->whereMonth('month_name',date('m',strtotime($empExpenditure->expenditure_date)))
//                    ->first();
//
//                if (!empty($monthlyRemaining)){
//                    $monthlyRemaining->update(['remaining_amount'=>$monthlyRemaining->remaining_amount-$data->amount]);
//                }else{
//
//                    MonthlyRemaining::create([
//                        'user_id'=>$empExpenditure->user_id,
//                        'month_name'=>date('Y-m-d',strtotime($empExpenditure->expenditure_date)),
//                        'remaining_amount'=>$data->amount
//                    ]);
//                }
//
//
//            }
            // end -----



            $empExpenditure->update(['updated_by'=>Auth::user()->id,'status'=>$request->status==1?$request->status==1:0]);

            $data->update($input);
            DB::commit();
            $bug=0;
        }catch(Exception $e){
            DB::rollback();
            $bug=$e->errorInfo[1];
            $bug2=$e->errorInfo[1];
        }
        if($bug==0){
            return redirect()->back()->with('success','Transaction Successfully Approved');
        }else{
            return redirect()->back()->with('error','Something Error Found ! ');
        }
    }


    public function showBorrowRepayRequest(){
        $users=User::where(['status'=>1])->whereNotIn('id',[1])->orderBy('id','DESC')->pluck('name','id');
        return view('backend.finance.expenditure.borrow-repay-request',compact('users'));
    }


    public function showBorrowRepayRequestList(Request $request){

        $borrowRepayRequest=EmpExpenditure::join('emp_money_transactions','emp_expenditures.id','emp_money_transactions.emp_expenditure_id')
             ->leftJoin('users as fromUsers','emp_money_transactions.from_user_id','fromUsers.id')
            ->leftJoin('users as toUsers','toUsers.id','emp_money_transactions.to_user_id')
            ->select('fromUsers.name as fromUserName','toUsers.name as toUserName','emp_money_transactions.status as trxStatus',
                'emp_money_transactions.details','emp_expenditures.*')
            ->orderBy('emp_expenditures.id','DESC');

        if (isset($request->purpose) && $request->purpose!=''){
            $borrowRepayRequest=$borrowRepayRequest->where('emp_expenditures.purpose',$request->purpose);
        }

        if (isset($request->purpose) && $request->purpose!=''){
            $borrowRepayRequest=$borrowRepayRequest->where('emp_expenditures.purpose',$request->purpose);
        }


        if (isset($request->start_date) && $request->start_date!=null && isset($request->end_date) && $request->end_date!=null){
            $startDate=date('Y-m-d',strtotime($request->start_date));
            $endDate=date('Y-m-d',strtotime($request->end_date));

            $borrowRepayRequest=$borrowRepayRequest->whereBetween('emp_expenditures.expenditure_date',[$startDate, $endDate]);

        }else if (isset($request->start_date) && $request->start_date!=null){
            $expenditureDate=date('Y-m-d',strtotime($request->start_date));
            $borrowRepayRequest=$borrowRepayRequest->whereDate('emp_expenditures.expenditure_date', '>=', $expenditureDate);

        }else if (isset($request->end_date) && $request->end_date!=null){
            $expenditureDate=date('Y-m-d',strtotime($request->end_date));
            $borrowRepayRequest=$borrowRepayRequest->where('emp_expenditures.expenditure_date','<',$expenditureDate);
        }



        return DataTables::of($borrowRepayRequest)
            ->addIndexColumn()
            ->addColumn('DT_RowIndex','')
            ->addColumn('Date','<?php echo date(\'d-M-Y\',strtotime($expenditure_date))?>')
            ->addColumn('purpose',
                '@if($purpose==5)
                <span class="btn btn-info btn-xs">Borrow Repay </span>
                @elseif($purpose==6)
                <span class="btn btn-info btn-xs">Borrow(Give) </span>
                @endif')

            ->addColumn('Status',
                '@if($trxStatus==0)
                <span class="btn btn-warning btn-xs">Pending </span>
                @elseif($trxStatus==2)
                <span class="btn btn-danger btn-xs">Rejected</span>
                @elseif($trxStatus==1)
                <span class="btn btn-info btn-xs">Approve</span>
                @endif')

            ->addColumn('action','
                {{Form::open(array(\'route\'=>[\'expenditure.destroy\',$id],\'method\'=>\'DELETE\',\'class\'=>\'deleteForm\',\'id\'=>"deleteForm$id"))}}
                @if($trxStatus==0)
                    <a href="{{URL::to(\'expenditure/\'.$id.\'?status=1\')}}" onclick="return confirm(\'Are you sure to approve this transaction ?\')" title="Click here to approve this transaction" class="btn btn-xs btn-success"> Approve? </a>    
                    @endif
                    <button type="button" class="btn btn-danger btn-xs" onclick=\'return deleteConfirm("deleteForm{{$id}}")\'><i class="fa fa-trash"></i></button>
                {{ Form::close()}}
            ')->rawColumns(['Date','purpose','Status','action'])->toJson();
    }

//<a href="{{URL::to('expenditure/'.$id.'?status=2')}}" onclick="return confirm('Are you sure to Reject this transaction ?')" title="Click here to Reject this transaction" class="btn btn-xs btn-warning"> Reject? </a>
//
//@elseif($trxStatus==1)
//<a href="{{URL::to('expenditure/'.$id.'?status=2')}}" onclick="return confirm('Are you sure to Reject this transaction ?')" title="Click here to Reject this transaction" class="btn btn-xs btn-warning"> Reject? </a>
//@elseif($trxStatus==2)
//<a href="{{URL::to('expenditure/'.$id.'?status=1')}}" onclick="return confirm('Are you sure to Approve this transaction ?')" title="Click here to Approve this transaction" class="btn btn-xs btn-success"> Approve? </a>



    public function showTransactionRequest(){
        $users=User::where(['status'=>1])->whereNotIn('id',[1])->orderBy('id','DESC')->pluck('name','id');
        return view('backend.finance.expenditure.transaction-request',compact('users'));
    }


    public function showTransactionRequestList(Request $request){

        $expenditure=EmpExpenditure::join('emp_money_transactions','emp_expenditures.id','emp_money_transactions.emp_expenditure_id')
            ->leftJoin('users as fromUsers','emp_money_transactions.from_user_id','fromUsers.id')
            ->leftJoin('users as toUsers','toUsers.id','emp_money_transactions.to_user_id')
            ->select('fromUsers.name as fromUserName','toUsers.name as toUserName','emp_money_transactions.status as trxStatus',
                'emp_money_transactions.details','emp_money_transactions.to_user_id','emp_money_transactions.from_user_id',
                'emp_money_transactions.transaction_type','emp_expenditures.*')
            ->where('emp_money_transactions.from_user_id',Auth::user()->id)->orWhere('emp_money_transactions.to_user_id',Auth::user()->id)
            ->orderBy('emp_expenditures.id','DESC');

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
                '@if($transaction_type==2 && $from_user_id==Auth::user()->id)
                <span class="btn btn-info btn-xs">Borrow(Give) to Colleague  </span>
                
                @elseif($transaction_type==1 && $from_user_id==Auth::user()->id)
                <span class="btn btn-info btn-xs"> Borrow Repay to Colleague </span>
                
                @elseif($transaction_type==2 && $to_user_id==Auth::user()->id)
                <span class="btn btn-info btn-xs"> Borrow form Colleague </span>
                
                @elseif($transaction_type==1 && $to_user_id==Auth::user()->id)
                <span class="btn btn-info btn-xs"> Borrow Return form Colleague </span>
                
                @endif')

            ->addColumn('Status',
                '@if($trxStatus==0)
                <span class="btn btn-warning btn-xs">Pending </span>
                @elseif($trxStatus==2)
                <span class="btn btn-danger btn-xs">Rejected</span>
                @elseif($trxStatus==1)
                <span class="btn btn-info btn-xs">Approve</span>
                @endif')
            ->rawColumns(['Date','purpose','Status'])->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmpExpenditure  $empExpenditure
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $expenditure=EmpExpenditure::with('accommodationOfExpenditure')->findOrFail($id);
        $users=User::where(['status'=>1])->where('id','!=',1)->orderBy('id','DESC')->pluck('name','id');
        $purpose=CommonWork::expenditurePurpose();
        return view('backend.finance.expenditure.expenditureModal',compact('users','purpose','expenditure'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmpExpenditure  $empExpenditure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'expenditure_date'=> 'required|date',
            'purpose'=> 'required|max:250',
            'amount'=> 'required|max:99999999999',
            "phone_bill_trxid" => "required_if:purpose,==,3",
            "miscellaneous" => "required_if:purpose,==,7",
            "hotel_name" => "required_if:purpose,==,4",
            "no_of_night" => "required_if:purpose,==,4",
            "facilities" => "required_if:purpose,==,4",
            "contact_name" => "required_if:purpose,==,4",
            "contact_phone" => "required_if:purpose,==,4",
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $expenditureData=EmpExpenditure::find($id);
        if (empty($empExpenditure)){
            return redirect()->back()->with('error','Trx request may be deleted');
        }

        $monthlyAssignAmount=MoneyAssignToEmp::whereMonth('assign_date',date('m'))
            ->where(['user_id'=>Auth::user()->id,'type'=>'for_expenditure'])->sum('amount');

        if ($monthlyAssignAmount==0){ // expense not allowed without monthly money assign----
            return redirect()->back()->with('error','Currently you have\'t assign amount! pls contact with your admin');
        }

        // can't give or repay over monthly assign amount ----
        if (($request->purpose==6 || $request->purpose==5) && $request->amount>$monthlyAssignAmount){
            return redirect()->back()->with('error','You can not exceed the limit amount');
        }

        DB::beginTransaction();
        try{

            if ($request->expenditure_date!=''){

                if (date('m',strtotime($request->expenditure_date))!=date('m',strtotime($expenditureData->expenditure_date))){
                    return redirect()->back()->with('error','You can\'t change expenditure month !');
                }
                $input['expenditure_date']=date('Y-m-d',strtotime($request->expenditure_date));
            }
            $input['updated_by']=Auth::user()->id;

            if ($request->purpose==5 || $request->purpose==6){
                $input['status']=0;
            }
//            else{
//                $monthlyRemaining=MonthlyRemaining::where(['user_id'=>Auth::user()->id])
//                    ->whereYear('month_name',date('Y',strtotime($request->expenditure_date)))
//                    ->whereMonth('month_name',date('m',strtotime($request->expenditure_date)))
//                    ->first();
//
//                if (!empty($monthlyRemaining)){ // if trx request not approved. remove last expend amount and add updated amount ----
//                    $amountData=($monthlyRemaining+$expenditureData->amount)-$request->amount;
//                    $monthlyRemaining->update(['remaining_amount'=>$amountData]);
//                }
//            }


            $expenditureData->update($input);

            if (isset($request->accommodation_id) && $request->accommodation_id!=''){
                $accommodation=Accommodation::findOrFail($request->accommodation_id);
                $accommodation->update($input);
            }

            if ($request->purpose==5){  // Borrow repay
                $data=EmpMoneyTransaction::where('emp_expenditure_id',$id)->first();
                $input['status']=0; // 0=Pending, 1=Approved;

                if (!empty($data)){
                    $data->update($input);
                }
            }

            if ($request->purpose==6){ // Borrow give
                $data=EmpMoneyTransaction::where('emp_expenditure_id',$id)->first();
                $input['status']=0; // 0=Pending, 1=Approved;
                if (!empty($data)){
                    $data->update($input);
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
            if ($request->purpose==5){
                return redirect()->back()->with('error','Your borrow repay waiting for review');
            }elseif($request->purpose==6){
                return redirect()->back()->with('error','Your borrow give waiting for review');
            }

            return redirect()->back()->with('success','Data Successfully Update');
        }else{
            return redirect()->back()->with('error','Something Error Found ! ');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmpExpenditure  $empExpenditure
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $empExpenditure=EmpExpenditure::findOrFail($id);
            $accommodation=Accommodation::where(['emp_expenditure_id'=>$id])->first();
            $moneyTransaction=EmpMoneyTransaction::where(['emp_expenditure_id'=>$id])->first();

            // remove amount from remaining amount -----
            $senderMonthlyRemaining=MonthlyRemaining::where(['user_id'=>$empExpenditure->user_id])
                ->whereYear('month_name',date('Y',strtotime($empExpenditure->expenditure_date)))
                ->whereMonth('month_name',date('m',strtotime($empExpenditure->expenditure_date)))
                ->first();

            // check borrow give or repay
            if (!empty($moneyTransaction)){

                $toUserMonthlyRemaining=MonthlyRemaining::where(['user_id'=>$moneyTransaction->to_user_id])
                    ->whereYear('month_name',date('Y',strtotime($empExpenditure->expenditure_date)))
                    ->whereMonth('month_name',date('m',strtotime($empExpenditure->expenditure_date)))
                    ->first();

                if (!empty($toUserMonthlyRemaining) && $moneyTransaction->status==1){

                    $toUserMonthlyRemaining->update(['remaining_amount'=>$toUserMonthlyRemaining->remaining_amount-$empExpenditure->amount]);
                }

                if (!empty($senderMonthlyRemaining) && $moneyTransaction->status==1){
                    $senderMonthlyRemaining->update(['remaining_amount'=>$senderMonthlyRemaining->remaining_amount+$empExpenditure->amount]);
                }


            }
//            else {  // without borrow give Or repay ---------
//                $senderMonthlyRemaining->update(['remaining_amount' => $senderMonthlyRemaining->remaining_amount + $empExpenditure->amount]);
//            }

           if (!empty($accommodation)){
               $accommodation->delete();
           }
           if (!empty($moneyTransaction)){
               $moneyTransaction->delete();
           }
            $empExpenditure->delete();
            DB::commit();
            $bug=0;
        }catch(Exception $e){
            DB::rollback();
            $bug=$e->errorInfo[1];
            $bug2=$e->errorInfo[1];
        }

        if($bug==0){
            return redirect()->back()->with('success','Expenditure Data Successfully Deleted!');
        }elseif($bug==1451){
            return redirect()->back()->with('error','This Data is Used anywhere ! ');
        }
    }
}
