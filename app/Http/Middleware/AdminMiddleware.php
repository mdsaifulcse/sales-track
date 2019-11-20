<?php

namespace App\Http\Middleware;
use Closure;
use Auth;
use App\Model\UserInfo;
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(\Auth::check()){
            if(\Auth::user()->type==2){

                $userInfo=UserInfo::where('user_id',\Auth::user()->id)->first();

                $programStudy=ProgramStudies::orderBy('id','desc')->where('user_id',Auth::user()->id)->first();;

                if ($userInfo=='' || $userInfo->final_step==0 || $programStudy->status==0 || $programStudy->status==1){
                    \Auth::logout();
                    return redirect('http://join.achievementcc.com/user-login');
                }

            }


        }else{
          return redirect('user-login');
        }
        return $next($request);
    }
}
