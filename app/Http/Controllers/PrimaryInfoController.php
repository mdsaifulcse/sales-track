<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use MyHelper,Validator;
use App\Models\PrimaryInfo;

class PrimaryInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=PrimaryInfo::first();
        return view('backend.primary_info.primaryinfo',compact('data'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

        $input = $request->all();


        $data=PrimaryInfo::findOrFail($request->id);
          
        if ($request->hasFile('logo')) {
            $photo=$request->file('logo');
            $path=base_path().'/images/logo';
            if (!is_dir($path)) {
                mkdir("$path",0777,true);
            }
            $img=\Image::make($photo);
            $img->resize(180, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save('images/logo/logo.png');
            //$input['logo']='images/logo/logo.png';
        }

        if ($request->hasFile('logo')){
            $input['logo']=MyHelper::photoUpload($request->file('logo'),'images/company-logo/',240);

            if (file_exists($data->logo)){
                unlink($data->logo);
            }
        }


        if ($request->hasFile('logo_ban')) {
            $photo=$request->file('logo_ban');
            $path=base_path().'/images/logo';
            if (!is_dir($path)) {
                mkdir("$path",0777,true);
            }
            $img=\Image::make($photo);
            $img->resize(180, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save('images/logo/logo_ban.png');
            $input['logo_ban']='images/logo/logo_ban.png';
        }

        if ($request->hasFile('favicon')) {
            $photo=$request->file('favicon');
            $path=base_path().'/images/logo';
            if (!is_dir($path)) {
                mkdir("$path",0777,true);
            }
            $img=\Image::make($photo)->resize(50,50);
            $img->save('images/logo/favicon.png');
            $input['favicon']='images/logo/favicon.png';
        }

        try{
            $data->update($input);

            $bug=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }
        if($bug==0){
            return redirect()->back()->with('success','Successfully Update');
        }else{
            return redirect()->back()->with('error','Something Error Found ! ');
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
}
