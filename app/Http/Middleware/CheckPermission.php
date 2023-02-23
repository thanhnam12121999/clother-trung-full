<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission = null)
    {
        // if (auth()->guard('accounts')->user()->checkPermissionAccess($permission))
        if (getLoggedInUser()->checkPermissionAccess($permission) || getAccountInfo()->hasRole('Admin'))
        {
            return $next($request);
        }
        return abort(403);
    }
}
