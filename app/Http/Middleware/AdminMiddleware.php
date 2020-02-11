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
        $authRole=\MyHelper::userRole();
        if($authRole->role=='stuff'){

            redirect('/stuff-dashboard');
            return $next($request);

        }


        if(\Auth::check()){

        }else{
          return redirect('user-login');
        }
        return $next($request);
    }
}
