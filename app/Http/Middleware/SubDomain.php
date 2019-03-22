<?php

namespace App\Http\Middleware;

use Closure;
use App\Tenant;
//use Log;
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
        // https://foo123.example.com から foo123 を取り出す
        // もしhttps://example.com でアクセスされた場合はexample.comが$subdomainにセットされる
        list($subdomain) = explode('.', $request->getHost(), 2);
        $tenant = Tenant::find($subdomain);
        if(empty($tenant))
        {
          die('テナントがDBに見つからンゴ(´･ω･`)');
        }
        config(['tid' => $subdomain]);
        config(['tenantName' => $tenant->name]);
        return $next($request);
    }
}
