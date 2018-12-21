<?php

namespace App\Http\Middleware;

use Closure;
//use Log;
//use View;
class SubDomain
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

        list($subdomain) = explode('.', $request->getHost(), 2);

        //$subdomain = $request->('subdomain');
        if(empty($subdomain)) {
          die('死んだンゴ');
        }
        logger('subdomain: '.$subdomain);
        //$request->subdomain = $subdomain;
        config(['tid' => $subdomain]);
        //View::share(['subdomain' => $subdomain]);
        return $next($request);
    }
}
