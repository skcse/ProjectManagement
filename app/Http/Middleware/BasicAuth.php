<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class BasicAuth
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
        $dataEncoded = $request->header("authorization");
        $data = explode(' ',$dataEncoded);
        $dataDecoded =  base64_decode($data[1]);
        $data = explode(':',$dataDecoded);
        $email = $data[0];
        $pass = $data[1];
        if(Auth::attempt(['email'=>$email,'password'=>$pass]))
        {
            return $next($request);
        }
        else {
            header('HTTP/1.1 401 Authorization Required');
            header('WWW-Authenticate: Basic realm="Access denied"');
            exit;
        }
    }
}
