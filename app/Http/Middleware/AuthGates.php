<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\ManagementAccess\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class AuthGates
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

        // get all user
        $user = Auth::user();


        // checking if system is active or not
        // checking if user is already logged in
        if (!app()->runningInConsole() && $user) {

            $roles              = Role::with('permission')->get();
            $permissionsArray   = [];

            foreach ($roles as $role) {
                foreach ($role->permission as $permissions) {
                    $permissionsArray[$permissions->title][] = $role->id;
                }
            }

            // checking if user has access to all roles
            foreach ($permissionsArray as $permission => $roles) {
                Gate::define($permission, function (\App\Models\User $user)
                use ($roles) {

                    return count(array_intersect($user->role->pluck('id')->toArray(), $roles)) > 0;
                });
            }
        }

        return $next($request);
    }
}
