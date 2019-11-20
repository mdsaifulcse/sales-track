<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use App\Model\Page;
use App\Model\PagePhoto;


class PagesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allData=Page::orderBy('id','desc')
            ->paginate(15);
        return view('backend.page.index',compact('allData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.page.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [  
                    'link'  => 'required|max:50|unique:page,link', 
                    'name'  => 'required', 
                    'title' => 'required',
                    'file' => 'mimes:pdf',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
            $input = $request->all();
            $link=str_replace(' , ', '-', $input['link']);
            $link=str_replace(', ', '-', $link);
            $link=str_replace(' ,', '-', $link);
            $link=str_replace(',', '-', $link);
            $link=str_replace('/', '-', $link);
            $link=rtrim($link,' ');
            $link=str_replace(' ', '-', $link);
            $link=strtolower($link);
            $input['link']=$link;
            /*Upload PDF File*/
            if ($request->hasFile('file')) {
                $file=$request->file('file');
                $fileType=$file->getClientOriginalExtension();
                $fileName=rand(1,1000).date('dmyhis').".".$fileType;
                /*$fileName=$file->getClientOriginalName();*/
                $file->move('public/files/page',$fileName);
                $input['file']=$fileName;
            }
            /*--Upload photo into package--*/
             if ($request->hasFile('photo')) {
                $j='';
                //print_r($_FILES['photo']['name']);
                for ($i=0; $i < count($_FILES['photo']['name']); $i++) {
                    
                    $photo=$request->file('photo')[$i];
                    $fileType=substr($_FILES['photo']['type'][$i], 6);
                    $fileName=rand(1,1000).date('dmyhis').".".$fileType;
                    if($j===''){
                        $j=$fileName;
                    }else{
                        $j=$j.','.$fileName;
                    }
                    $validextensions = array("jpeg", "jpg", "png","JPEG","JPG","PNG");  //Extensions which are allowed
                    $ext = explode('.', basename($_FILES['photo']['name'][$i]));//explode file name from dot(.) 
                    $file_extension = end($ext); //store extensions in the variable
                    if (($_FILES["photo"]["size"][$i] > 2000000) //Approx. 2000kb files can be uploaded.
                        | !in_array($file_extension, $validextensions)) {
                        return redirect()->back()->with('error','Invalid file Size or Type ! ')->withInput();
                    }
                    $img=\Image::make($photo)->resize(850,850);
                    $img->save('public/img/page/'.$fileName );
                    $pagePhoto=explode(',', $j);
                }
                
            }else{
                unset($input['photo']);
            }
            $currentId=Page::create($input)->id;
            $input2=array();
            if (isset($pagePhoto)) {
            $input2['fk_page_id']=$currentId;
               for ($i=0; $i < sizeof($pagePhoto); $i++) { 
                $input2['photo']=$pagePhoto[$i];
                PagePhoto::create($input2);
                } 
            }
            

            try{
                
            $bug=0;
            }catch(\Exception $e){
                $bug=$e->errorInfo[1];
            }
             if($bug==0){
            return redirect("pages/$currentId/edit")->with('success','Data Successfully Inserted');
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
        $data=Page::findOrFail($id);
        $data['photo']=PagePhoto::where('fk_page_id',$id)->get();
        return view('backend.page.packageDetails',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Page::findOrFail($id);
        $data['photo']=PagePhoto::where('fk_page_id',$id)->get();
        return view('backend.page.edit',compact('data'));
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
        $data=Page::findOrFail($request->id);
        $link=str_replace(' , ', '-', $input['link']);
        $link=str_replace(', ', '-', $link);
        $link=str_replace(' ,', '-', $link);
        $link=str_replace(',', '-', $link);
        $link=str_replace('/', '-', $link);
        $link=rtrim($link,' ');
        $link=str_replace(' ', '-', $link);
        $link=strtolower($link);
        $input['link']=$link;
        $validator = Validator::make($request->all(), [
                    'name'      => 'required', 
                    'title'  => 'required',
                    'link'  => "required|max:50|unique:page,link,$id", 
                ]);
        
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
            /*Upload PDF File*/
            if ($request->hasFile('file')) {
                $file=$request->file('file');
                $fileType=$file->getClientOriginalExtension();
                $fileName=rand(1,1000).date('dmyhis').".".$fileType;
                /*$fileName=$file->getClientOriginalName();*/
                $file->move('public/files/page',$fileName);
                $input['file']=$fileName;
                $file_path='public/files/page/'.$data['file'];

                if($data['file']!=null and file_exists($file_path)){
                unlink($file_path);
                }
            }
            /*-- Photo Upload --*/
        if ($request->hasFile('photo')) {
            $p='';
            for ($i=0; $i < count($_FILES['photo']['name']); $i++) {
                    $photo=$request->file('photo')[$i];
                    $fileType=substr($_FILES['photo']['type'][$i], 6);
                    $fileName=rand(1,1000).date('dmyhis').".".$fileType;
                    if($p===''){
                        $p=$fileName;
                    }else{
                        $p=$p.','.$fileName;
                    }
                    $validextensions = array("jpeg", "jpg", "png","JPEG","JPG","PNG");  //Extensions which are allowed
                    $ext = explode('.', basename($_FILES['photo']['name'][$i]));//explode file name from dot(.) 
                    $file_extension = end($ext); //store extensions in the variable
                    if (($_FILES["photo"]["size"][$i] > 1000000) //Approx. 100kb files can be uploaded.
                        | !in_array($file_extension, $validextensions)) {
                        return redirect()->back()->with('error','Invalid file Size or Type ! ')->withInput();
                    }
                    if($photo!=null){
                    $img=\Image::make($photo)->resize(850,350);
                    $img->save('public/img/page/'.$fileName );   
                    }
                    
                    $page_photo=explode(',', $p);
                    
                }

            }
            /*--Delete Photo--*/
            if(isset($input['del_photo'])){
                
                for ($i=0; $i <sizeof($input['del_photo']) ; $i++) { 
                    $deletePhoto=PagePhoto::findOrFail($input['del_photo'][$i]);
                    $img_path='public/img/page/'.$deletePhoto['photo'];
                    if(file_exists($img_path)){
                    unlink($img_path);
                    }
                    $deletePhoto->delete();
                }
            }
            
        try{
            $data->update($input);
            

            if (isset($page_photo)) {
            $input2['fk_page_id']=$id;
               for ($i=0; $i < sizeof($page_photo); $i++) { 
                $input2['photo']=$page_photo[$i];
                PagePhoto::create($input2);
                } 
            } 
            $bug=0;
            }catch(\Exception $e){
                $bug=$e->errorInfo[1];
            }
             if($bug==0){
            return redirect()->back()->with('success','Data Successfully Updated');
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
        $data=Page::findOrFail($id);
        $pagePhoto=PagePhoto::where('fk_page_id',$id)->get();
        foreach ($pagePhoto as $row) {
            $img_path='public/img/page/'.$row['photo'];
            if($row['photo']!=null and file_exists($img_path)){
               unlink($img_path);
            }
        }
        $file_path='public/files/page/'.$data['file'];
        if($data['file']!=null and file_exists($file_path)){
           unlink($file_path);
        }
       
       try{
        PagePhoto::where('fk_page_id',$id)->delete();
        
            $data->delete();
            $bug=0;
            $error=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            $error=$e->errorInfo[2];
        }
        if($bug==0){
       return redirect('pages')->with('success','Data has been Successfully Deleted!');
        }elseif($bug==1451){
       return redirect('pages')->with('error','This Data is Used anywhere ! ');

        }
        elseif($bug>0){
       return redirect('pages')->with('error','Some thing error found !');

        }
    }

    
}
