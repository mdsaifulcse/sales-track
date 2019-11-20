<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UserInfo;
use App\Model\StudentPayment;
use Auth;
use Session;
use PDF;
use App;
use App\Model\Branch;
use App\User;
use Mail;
use App\JWT;

class IndexController extends Controller
{
    public function home()
    {
    	return view('client/home');
    }
    public function login()
    {
    	return view('auth/login');
    }
    public function comingSoon()
    {
    	return view('backend.extraPage.comingSoon');
    }
    public function lockStudent()
    {
    	return view('backend.extraPage.lockStudent');
    }

    public function index()
    {

//    	Auth::logout();
    	$branch = Branch::pluck('name','id');

    	return view('client/index',compact('branch'));
    }

      public function dashboard()
    {
        $info = UserInfo::where('user_id',\Auth::user()->id)->first();
        $payment = StudentPayment::where('user_id',\Auth::user()->id)->count();

        return view('client/dashboard',compact('info','payment'));
    }
    public function privacy()
    {

        return view('client/privacy');
    }
    public function infornationview()
    {

        $info = UserInfo::where('user_id',Auth::user()->id)->first();
        if($info==''){
            return redirect()->back();
        }

        $branches=Branch::orderBy('id','desc')->select('id','name')->get();

        $bkashPayment=StudentPayment::where('user_id',Auth::user()->id)->whereNotNull('trx_id')->sum('amount');
        $cashPayment=StudentPayment::where('user_id',Auth::user()->id)->whereNull('trx_id')->sum('amount');

        $due=$info->payable_amount-($bkashPayment+$cashPayment);


        return view('client/informationview',compact('info','bkashPayment','cashPayment','due','branches'));;

    }

    public function downloadForm(){
        $info = UserInfo::where('user_id',Auth::user()->id)->first();
        if($info==''){
            return redirect()->back();
        }

        $branches=Branch::orderBy('id','desc')->select('id','name')->get();

        $bkashPayment=StudentPayment::where('user_id',Auth::user()->id)->whereNotNull('trx_id')->sum('amount');
        $cashPayment=StudentPayment::where('user_id',Auth::user()->id)->whereNull('trx_id')->sum('amount');

        $due=$info->payable_amount-($bkashPayment+$cashPayment);
        $pdf = PDF::loadView('client/formPdf',compact('info','bkashPayment','cashPayment','due','branches'))->setPaper('a4', 'portrait');
        //return $pdf->stream();
        return $pdf->download('registration-form.pdf');
    }


    public function logout()
    {
        if(Auth::check()){
            Auth::logout();
        }
        setcookie("bkash_cookie", "", time() - 3600,'/','.achievementcc.com');
        return redirect('/');
    }
    public function testNotice(){
        return view('client.notice');
    }
    public function externalLogin(Request $request){
        
        if(\Auth::check()){
            Auth::logout();
            setcookie("bkash_cookie", "", time() - 3600,'/','.achievementcc.com');
        }
        $data = $request->token;
        if(isset($request->token) && $request->token!='' && JWT::decode($data, 'leam@123456')){
            $user = JWT::decode($data,'leam@123456');
            $array = json_decode($user,true);
            $dbUser = User::where($array)->first();
            if($dbUser!=''){
                Auth::login($dbUser);
                return redirect('home');
            }else{
                return redirect('login');
            }
        }else{
            return redirect('login'); 
        }
    }

}
