<?php

namespace App\Http\Middleware;

use App\Enums\UserRoleEnum;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole extends Middleware
{
    protected $DIRECTOR = UserRoleEnum::DIRECTOR->value;
    protected $LEADER = UserRoleEnum::LEADER->value;
    protected $GROUP_LEADER = UserRoleEnum::GROUP_LEADER->value;
    protected $MEMBER = UserRoleEnum::MEMBER->value;
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = $request->user();
        foreach ($roles as $role) {
            if ($role === "director") {
                $role = UserRoleEnum::DIRECTOR->value;
            }

            if ($role === "leader") {
                $role = UserRoleEnum::LEADER->value;
            }

            if ($role === "groupLeader") {
                $role = UserRoleEnum::GROUP_LEADER->value;
            }

            if ($role === "member") {
                $role = UserRoleEnum::MEMBER->value;
            }

            if ($user->position_id === $role) {

                return $next($request);
            }
        }
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
