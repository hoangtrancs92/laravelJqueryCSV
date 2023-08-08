<?php

namespace App\Services;

use Illuminate\Support\Facades\{
    Auth,
    Session
};
use App\Helpers\{
    CommonHelper
};
/**
 * Class AuthService
 *
 * A library for Authentication feature.
 */
class AuthService
{

    /**
     * AuthService constructor.
     *
     */
    private CommonHelper $commonHelper;
    public function __construct(CommonHelper $commonHelper) {
        $this->commonHelper = $commonHelper;
    }

    /**
    ** Function Login
    ** @param string $a
    ** @return mixed|string|object
    **/
    public function getLogin($request, $currentUserflg)
    {
        $user = $currentUserflg;
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $auth = [
                'name' => $this->commonHelper->longTextToThreeDots($user->name, 18) ,
                'email' => $user->email,
                'id' => $user->id,
                'user_flg' => $user->user_flg
            ];
            Session::put($auth);
            return true;
        }
        else {
            return false;
        }
    }

    // Logout
    public function getLogout($request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return true;
    }
}
