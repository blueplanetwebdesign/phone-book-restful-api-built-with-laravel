<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ApiAuthMiddleware
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
        $credentials = array(
            'email'    => 'andrew@blueplanetwebdesign.co.uk',
            'api_token' => '$2y$10$G9QgRGfnoKmyYg4ZLRxRJuKQ1F.bFJyvN0QFeXEObpmwVmL0/a5FW'
        );

        //die('test');

        if(!Auth::onceBasic('email', $credentials)){

            die('test');
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }
}
