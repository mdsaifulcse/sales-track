<?php

namespace App\Http\Controllers;

use App\Models\BusinessYear;
use Illuminate\Http\Request;
use Auth,Validator,DB;
use Illuminate\Support\Facades\Bus;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class BusinessYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $businessYears=BusinessYear::orderBy('id','desc')->paginate(12);
        return view('backend.business-year.index',compact('businessYears'));
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

        $validator = Validator::make($request->all(),[
            'year_name' => 'required|max:50|unique:business_years']);
        if($validator->fails()){
            return redirect()->back()->with('error',$request->year_name.' Already Exist');
        }

        $input = $request->except('_token');
        $input['created_by']=Auth::user()->id;

        try {
            BusinessYear::create($input);

            $bug = 0;

        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }

        if($bug == 0){
            return redirect()->back()->with('success','New Category Info Created Successfully.');
        }else{
            return redirect()->back()->with('error','Error: '.$bug1);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BusinessYear  $businessYear
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessYear $businessYear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BusinessYear  $businessYear
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessYear $businessYear)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BusinessYear  $businessYear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'year_name' => "required|max:50|unique:business_years,year_name,$id"]);
        if($validator->fails()){return redirect()->back()->with('error',$request->year_name.' Already Exist');}
        $itemCategoryById=BusinessYear::findOrFail($id);

        $input = $request->except('_token');
        $input['updated_by']=Auth::user()->id;

        try {
            $itemCategoryById->update($input);

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
     * @param  \App\Models\BusinessYear  $businessYear
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $businessYear=BusinessYear::findOrFail($id);
        try {
            $businessYear->delete();

            $bug = 0;

        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }

        if($bug == 0){
            return redirect()->back()->with('success','Year Info Delete Successfully.');
        }elseif ($bug==1451){
            return redirect()->back()->with('error','Sorry This date can not be delete due to used another module.');
        }else{
            return redirect()->back()->with('error','Error: '.$bug1);
        }
    }
}
