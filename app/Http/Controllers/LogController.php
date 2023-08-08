<?php

namespace App\Http\Controllers;

use App\Helpers\ErrorMessagesHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Log\LoginRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\AuthService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\{
    RedirectResponse,
    Request
};

class LogController extends Controller
{
    private UserRepositoryInterface $userRepository;
    private AuthService $authService;
    public function __construct(UserRepositoryInterface $userRepository, AuthService $authService)
    {
        $this->userRepository = $userRepository;
        $this->authService = $authService;
    }

    public function renderA01()
    {
        if (Auth::check()) {
            return redirect()->route('render-use-a01');
        }
        return view('pages.Log.A01');
    }

    public function loginA01(LoginRequest $request)
    {
        $currentUserflg = $this->userRepository->getUserByEmail($request->email);
        if($currentUserflg == false)
        {
            redirect()->back()->withErrors(ErrorMessagesHelper::getErrorMessage('EBT016'))->withInput();
        }
        if ($currentUserflg != null) {
            $auth = $this->authService->getLogin($request, $currentUserflg);
            if ($auth) {
                return redirect()->intended('/user');
            } else {
                return redirect()->back()->withErrors(ErrorMessagesHelper::getErrorMessage('EBT016'))->withInput();
            }
        } else {
            return redirect()->back()->withErrors(ErrorMessagesHelper::getErrorMessage('EBT016'))->withInput();
        }

    }

    public function logout(Request $request): RedirectResponse
    {
        $this->authService->getLogout($request);
        return redirect()->route('render-log-a01');
    }
}
