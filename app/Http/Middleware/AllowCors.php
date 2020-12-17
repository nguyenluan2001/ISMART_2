<?php

namespace App\Http\Middleware;

use Closure;

class AllowCors
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
        header('Access-Control-Allow-Origin: *');
        $headers=[
            'Access-Control-Allow-Method'=>'POST, GET, PUT, DELETE',
            'Access-Control-Allow-Headers'=>'Content-Type, X-Auth-Token,Origin,Authorization',
        ];
        $response=$next($request);
        foreach($headers as $key=>$item)
        {
            $response->header($key,$item);
        }
        return $response;

    }
}
