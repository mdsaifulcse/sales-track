<?php

namespace App\Http\Controllers;

use App\Models\BudgetAllocation;
use Illuminate\Http\Request;
use Validator,DB,Auth;
use Yajra\DataTables\DataTables;

class BudgetAllocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budgetAllocations=[];

        return view('backend.finance.budget.index',compact('budgetAllocations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $budgetAllocations=BudgetAllocation::select('budget_allocations.*')
            ->orderBy('id','DESC');

        if (isset($request->start_date) && $request->start_date!=null && isset($request->end_date) && $request->end_date!=null){
            $startDate=date('Y-m-d',strtotime($request->start_date));
            $endDate=date('Y-m-d',strtotime($request->end_date));

            $budgetAllocations=$budgetAllocations->whereBetween('allocation_date',[$startDate, $endDate]);

        }else if (isset($request->start_date) && $request->start_date!=null){
            $assignDate=date('Y-m-d',strtotime($request->start_date));
            $budgetAllocations=$budgetAllocations->whereDate('allocation_date', '>=', $assignDate);

        }else if (isset($request->end_date) && $request->end_date!=null){
            $assignDate=date('Y-m-d',strtotime($request->end_date));
            $budgetAllocations=$budgetAllocations->where('allocation_date','<',$assignDate);
        }

        return DataTables::of($budgetAllocations)
            ->addIndexColumn()
            ->addColumn('DT_RowIndex','')
            ->addColumn('Date','<?php echo date(\'d-M-Y\',strtotime($allocation_date))?>')
            ->addColumn('Status','@if($status==1)
                <span class="btn btn-success btn-xs"><i class="fa fa-check"></i> Active </span>
                @elseif($status==0)
                <span class="btn btn-warning btn-xs"><i class="fa fa-warning"></i> Inactive </span>
                @endif')
            ->addColumn('action','


               <div class="modal fade" id="modal-dialog<?php echo $id;?>">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                {!! Form::open(array(\'route\' => [\'budget-allocation.update\',$id],\'class\'=>\'form-horizontal\',\'method\'=>\'PUT\',\'files\'=>true)) !!}
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit budget Info </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3">Status :</label>
                                        <div class="col-md-4 col-sm-4">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status" value="1" id="radio-required" data-parsley-required="true" @if($status=="1"){{"checked"}}@endif> Active
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status" id="radio-required2" value="0" @if($status=="0"){{"checked"}}@endif> Inactive
                                                </label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3">Allocation Date <sup class="text-danger">*</sup> :</label>
                                        <div class="col-md-8 col-sm-8">
                                            {{Form::text(\'allocation_date\',$value=date(\'d-m-Y\',strtotime($allocation_date)),[\'class\'=>\'form-control singleDatePicker\',\'placeholder\'=>\'Choose allocation date\',\'required\'=>true])}}
                                        </div>
                                    
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3">Purpose <sup class="text-danger">*</sup> :</label>
                                        <div class="col-md-8 col-sm-8">
                                            {{Form::text(\'purpose\',$value=$purpose,[\'class\'=>\'form-control\',\'placeholder\'=>\'Enter purpose\',\'required\'=>true])}}
                                        </div>
                                        
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3">Budget Amount <sup class="text-danger">*</sup> :</label>
                                        <div class="col-md-8 col-sm-8">
                                            {{Form::number(\'amount\',$value=$amount,[\'step\'=>\'any\',\'min\'=>\'0\',\'max\'=>99999999999,\'class\'=>\'form-control\',\'placeholder\'=>\'Enter amount\',\'required\'=>true])}}
                                        </div>
                                        
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <a href="javascript:;" class="btn btn-sm btn-danger pull-left" data-dismiss="modal">Close</a>
                                    <button type="submit" class="btn btn-sm btn-success">Update</button>
                                </div>
                                {!! Form::close(); !!}
                            </div>
                        </div>
                    </div>
                


                {{Form::open(array(\'route\'=>[\'budget-allocation.destroy\',$id],\'method\'=>\'DELETE\',\'class\'=>\'deleteForm\',\'id\'=>"deleteForm$id"))}}
                    <a href="#modal-dialog<?php echo $id;?>" title="Click here to edit this" class="btn btn-xs btn-warning" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    <button type="button" class="btn btn-danger btn-xs" onclick=\'return deleteConfirm("deleteForm{{$id}}")\'><i class="fa fa-trash"></i></button>
                {{ Form::close()}}
            ')->rawColumns(['Date','Status','action'])->toJson();
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
            'allocation_date'=> 'required|date',
            'purpose'=> 'required|max:250',
            'amount'=> 'required|max:99999999999'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{
//            $year=date('Y',strtotime($request->allocation_date));
//            $budget=BudgetAllocation::whereYear('allocation_date',$year)->first();
//
//            if (!empty($budget)){
//                return redirect()->back()->with('error','Budget already assign for '.$year);
//            }

            if ($request->allocation_date!=''){
                $input['allocation_date']=date('Y-m-d',strtotime($request->allocation_date));
            }

            $input['created_by']=Auth::user()->id;
            BudgetAllocation::create($input);

            $bug=0;
        }catch(Exception $e){
            $bug=$e->errorInfo[1];
        }
        if($bug==0){
            return redirect()->back()->with('success','Budget Successfully Save');
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
    public function edit(BudgetAllocation $budgetAllocation)
    {
        //
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
            'allocation_date'=> 'required|date',
            'purpose'=> 'required|max:250',
            'amount'=> 'required|max:99999999999',
            'status'=> 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $budget=BudgetAllocation::findOrFail($id);
        try{

//            $year=date('Y',strtotime($request->allocation_date));
//            $existBudget=BudgetAllocation::whereYear('allocation_date',$year)->where('id','!=',$budget->id)->first();
//
//            if (!empty($existBudget)){
//                return redirect()->back()->with('error','Budget already assign for '.$year);
//            }

            if ($request->allocation_date!=''){
                $input['allocation_date']=date('Y-m-d',strtotime($request->allocation_date));
            }
            $input['updated_by']=Auth::user()->id;
            $budget->update($input);
            $bug=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }
        if($bug==0){
            return redirect()->back()->with('success','Budget Successfully Update');
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
        $budget=BudgetAllocation::findOrFail($id);
        $budget->delete();
        $bug=0;
        $error=0;
    }catch(\Exception $e){
        $bug=$e->errorInfo[1];
        $error=$e->errorInfo[2];
    }
        if($bug==0){
            return redirect()->back()->with('success','Budget Successfully Deleted!');
        }elseif($bug==1451){
            return redirect()->back()->with('error','This Data is Used anywhere ! ');
        }
    }
}
