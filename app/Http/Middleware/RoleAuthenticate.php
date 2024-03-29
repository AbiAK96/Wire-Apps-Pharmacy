<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\API\AppBaseController;

class RoleAuthenticate extends AppBaseController
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if((auth()->user()->hasRole('owner')) || (auth()->user()->hasRole('manager')) || (auth()->user()->hasRole('cashier'))){
            return $next($request);
        }else{
            return $this->errorResponse('Unauthorized Access !.', 401);
        } 
    }
}
