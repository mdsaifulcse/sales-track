<?php

namespace App\Http\Controllers;

use App\Models\AssignTarget;
use App\User;
use Illuminate\Http\Request;
use DB,Auth,Validator;

class AssignTargetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assignTarget=AssignTarget::with('userOfTarget')->orderBy('id','desc')->paginate(18);
        $users=User::leftJoin('role_user','role_user.user_id','users.id')
            ->leftJoin('roles','roles.id','role_user.role_id')
            ->select('users.id',DB::raw('CONCAT(users.name, " ( ", roles.name, " )") as userName'))
            ->where('users.status',1)->where('roles.slug','=','stuff')
            ->orderBy('users.id','desc')->pluck('userName','users.id');
        return view('backend.assign-target.index',compact('assignTarget','users'));
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

       // return $request;

        $validator = Validator::make($request->all(),[
            'target_year' => 'required',
            'user_id' => 'required|exists:users,id',
            'annual_target_amount' => 'required|numeric',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $assignTargetData=AssignTarget::with('userOfTarget')->where(['target_year'=>$request->target_year,'user_id'=>$request->user_id])->first();

        if(!empty($assignTargetData)){
            return redirect()->back()->with('error','Target already assign to '
                .$assignTargetData->userOfTarget->name.' for '.$assignTargetData->target_year);
        }


        $input = $request->except('_token');
        $input['created_by']=Auth::user()->id;

        try {


            $input['quarterly_amount']=$request->annual_target_amount/4;
            for ($i=1;$i<=4;$i++){

                if ($i==1){
                    $input['target_months']='10-'.$request->target_year.', 11-'.$request->target_year.', 12-'.$request->target_year;
                }elseif ($i==2){
                    $input['target_months']='07-'.$request->target_year.', 08-'.$request->target_year.', 09-'.$request->target_year;
                }elseif($i==3){
                    $input['target_months']='04-'.$request->target_year.', 05-'.$request->target_year.', 06-'.$request->target_year;
                }elseif ($i==4){
                    $input['target_months']='01-'.$request->target_year.', 02-'.$request->target_year.', 03-'.$request->target_year;
                }
                AssignTarget::create($input);
            }

            $bug = 0;

        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }

        if($bug == 0){
            return redirect()->back()->with('success','Target Successfully Assign.');
        }else{
            return redirect()->back()->with('error','Error: '.$bug1);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssignTarget  $assignTarget
     * @return \Illuminate\Http\Response
     */
    public function show(AssignTarget $assignTarget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\AssignTarget  $assignTarget
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignTarget $assignTarget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssignTarget  $assignTarget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'quarterly_amount' => 'required|numeric',
        ]);
        if($validator->fails()){return redirect()->back()->with('error',' Assign Amount is Required ');}

        $quarterTargetData=AssignTarget::findOrFail($id);

        $input = $request->except('_token');
        $input['updated_by']=Auth::user()->id;

        try {
            $quarterTargetData->update($input);

            $bug = 0;

        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }

        if($bug == 0){
            return redirect()->back()->with('success','Old Year Update Successfully.');
        }else{
            return redirect()->back()->with('error','Error: '.$bug1);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\AssignTarget  $assignTarget
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $assignData=AssignTarget::findOrFail($id);
        DB::beginTransaction();
        try {
           $result= AssignTarget::where(['user_id'=>$assignData->user_id,'target_year'=>$assignData->target_year])->where('quarterly_achieve_amount','!>',0)->delete();

           if ($result!=4){
               return redirect()->back()->with('error','Data cont not be delete, due to partial/full target complete !');
           }

            $bug = 0;

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }

        if($bug == 0){
            return redirect()->back()->with('success','Assign Target Data Successfully Delete .');
        }elseif ($bug==1451){
            return redirect()->back()->with('error','Sorry This date can not be delete due to used another module.');
        }else{
            return redirect()->back()->with('error','Error: '.$bug1);
        }
    }
}
