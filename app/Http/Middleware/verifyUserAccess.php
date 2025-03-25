<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use DB;

class verifyUserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,...$roleName)
    {
        $user=Auth::user();

        if(!$user){
            return redirect()->route('main-dashboard')->with(['type'=>'danger','message'=>"You do not have access."]);
        }
        $user_id=$user['id'];

        $userRolePermission = DB::table('permissions')
        ->join('permission_role', 'permissions.id', '=', 'permission_role.permission_id')
        ->join('roles', 'roles.id', '=', 'permission_role.role_id')
        ->join('role_user','roles.id','=','role_user.role_id')
        ->join('users','users.id','=','role_user.user_id')
        ->select('permissions.permission_slug')
        ->where('users.id',$user_id)
        ->whereIn('roles.role_slug',$roleName)
        ->get()->toArray();

        if(!isset($userRolePermission) || $userRolePermission == []){
            return redirect()->route('main-dashboard')->with(['type'=>'danger','message'=>"You do not have access."]);
        }

        return $next($request);

    }
}
