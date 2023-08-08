<?php

namespace App\Http\Controllers;
use App\Helpers\{
    CommonHelper,
    CSVExportHelper,
    ErrorMessagesHelper
};
use App\Http\Controllers\Controller;
use App\Http\Requests\Use\SearchRequest;
use App\Http\Requests\Use\A02\{
    RegisterRequest,
    DirectorUpdateRequest,
    UserUpdateRequest,
    UserDirectorUpdateRequest
};
use App\Repositories\Interfaces\{
    UserRepositoryInterface,
    GroupRepositoryInterface
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Repositories\GroupRepository;
use App\Services\AuthService;
use App\Enums\UserRoleEnum;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UseController extends Controller
{
    private UserRepositoryInterface $userRepository;
    private CommonHelper $commonHelper;
    private GroupRepositoryInterface $groupRepository;
    private AuthService $authService;
    protected $DIRECTOR = UserRoleEnum::DIRECTOR->value;
    public function __construct(UserRepositoryInterface $userRepository, CommonHelper $commonHelper, GroupRepositoryInterface $groupRepository, AuthService $authService)
    {
        $this->userRepository = $userRepository;
        $this->groupRepository = $groupRepository;
        $this->commonHelper = $commonHelper;
        $this->authService = $authService;
        $this->middleware('checkrole:director', ['only' => ['csvExportA01', 'renderUserInfoA02', 'renderAddA02']]);
    }

    public function index()
    {
        $users = $this->userRepository->getAllUsers();
        if (Auth::check()) {
            return view('pages.Use.A01');
        }
        else{
            return view('pages.Log.A01');
        }

    }

    public function handleSearchA01(SearchRequest $request)
    {
        $request->startDateFrom = $this->commonHelper->dateFormatYear($request->startDateFrom);
        $request->startDateTo = $this->commonHelper->dateFormatYear($request->startDateTo);
        $users = $this->userRepository->searchUserA01($request);
        if ($users === null) {
            return view("pages.Use.A01", compact('error_message'));
        } else {
            Session::put('userSearch', $request->all());
            Session::save();
            return view("pages.Use.A01", compact('users'));
        }
    }

    public function csvExportA01(Request $params)
    {
        $request = $params->all();
        if($request != null) {
            $users = $this->userRepository->csvExportA01($request);
            if($users)
            {
                $header = array_values(['ID', 'User Name', 'Email', 'Group ID', 'Group Name', 'Started Date', 'Position', 'Created Date', 'Updated Date']);
                $filename = $this->commonHelper->changeNameCSV('list_user', 'csv');
                $csv = new CSVExportHelper($header, $filename, $users);
                return $csv->export();
            }
        } else {
            Session::forget('condition');
            return redirect('/user');
        }
    }

    public function renderA02()
    {
        return view('pages.Use.A02');
    }
    public function renderAddA02()
    {
        $results = [];
        $listGroup = $this->groupRepository->getListGroup();
        $results = [
            'listGroup' => $listGroup,
        ];

        return view('pages.Use.A02', compact('results'));
    }

    public function renderUserEditA02($id)
    {
        $infoUser = $this->userRepository->getInfoUser($id);

            if(Auth::user()->id == $id || Auth::user()->position_id == $this->DIRECTOR)
            {
                if($infoUser->deleted_date === null)
                {
                    $listGroup = $this->groupRepository->getListGroup();

                    $results = [
                        'listGroup' => $listGroup,
                        'infoUser' => $infoUser
                    ];

                    return view('pages.Use.A02', compact('results'));
                }
                else {
                    \Illuminate\Support\Facades\Session::flash('errorMessage', 'アクセス権限がありません。');
                    return redirect()->route('render-use-a01');
                }
            }
            else {
                Auth::logout();
                return redirect('/login');
            }
    }

    public function registerA02(RegisterRequest $request)
    {
        $startedDate= $this->commonHelper->dateFormatYear($request->startedDate);
        $data = [
            'email' => $request->email,
            'name' => $request->name,
            'password' => $request->password,
            'started_date' => $startedDate,
            'group_id' => $request->group,
            'position_id' => $request->position
        ];
        $result = $this->userRepository->createUserA02($data);
        if($result == true)
        {
            \Illuminate\Support\Facades\Session::flash('message', ErrorMessagesHelper::getErrorMessage('EBT096'));
            return redirect()->route('render-use-a01');
        } else {
            \Illuminate\Support\Facades\Session::flash('errorMessage', ErrorMessagesHelper::getErrorMessage('EBT093'));
            return redirect()->route('render-use-a01');
        }
    }

    public function userUpdateA02(UserUpdateRequest $request)
    {
        $currentUserflg = $this->userRepository->getUserById($request->userId);
        if($currentUserflg)
        {
            if(Auth::user()->position_id === $this->DIRECTOR)
            {
                $userDirectorUpdateRequest = new UserDirectorUpdateRequest();
                $validatedData = $request->validate($userDirectorUpdateRequest->rules(), $userDirectorUpdateRequest->messages());
                $startedDate= $this->commonHelper->dateFormatYear($request->startedDate);
                $data = [
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'group_id' => $request['group'],
                    'position_id' => $request['position'],
                    'started_date' => $startedDate,
                    'password' => $request['updatePassword']
                ];
                $result = $this->userRepository->updateUserA02($data, $request['userId']);
                if(isset($result['duplicated']))
                {
                    // return redirect()->back()->withErrors(ErrorMessagesHelper::getErrorMessage('EBT019', 'Email'));
                    return redirect()->route('render-use-info-a02', ['id' => $request['userId']])->withErrors(ErrorMessagesHelper::getErrorMessage('EBT019', 'Email'))->withInput(['email']);
                }
                if($result == true)
                {
                    \Illuminate\Support\Facades\Session::flash('message', ErrorMessagesHelper::getErrorMessage('EBT096'));
                    return redirect()->route('render-use-a01');
                }
                else {
                    \Illuminate\Support\Facades\Session::flash('errorMessage', ErrorMessagesHelper::getErrorMessage('EBT093'));
                    return redirect()->route('render-use-a01');
                }
            }
            else {
                $data = [
                    'password' => $request->all()['updatePassword']
                ];
                $result = $this->userRepository->updatePasswordUserA02($data, $request->all()['userId']);
                if($result == true)
                {
                    \Illuminate\Support\Facades\Session::flash('message', ErrorMessagesHelper::getErrorMessage('EBT096'));
                    return redirect()->route('render-use-a01');
                }
                else {
                    \Illuminate\Support\Facades\Session::flash('errorMessage', ErrorMessagesHelper::getErrorMessage('EBT093'));
                    return redirect()->route('render-use-a01');
                }
            }
        }
        else {
            \Illuminate\Support\Facades\Session::flash('errorMessage', '登録・更新・削除処理に失敗しました。');
            return redirect()->route('render-use-a01');
        }
    }

    public function userDeleteA02($id)
    {
        $currentUserflg = $this->userRepository->getUserById($id);
        if($currentUserflg)
        {
            if(Auth::user()->id == $id)
            {
                Session::flash('errorMessage', ErrorMessagesHelper::getErrorMessage('EBT086'));
                return redirect()->route('render-use-a01');
            }
            $result = $this->userRepository->deleteUserA02($id);
            if($result == true)
            {
                Session::flash('message', ErrorMessagesHelper::getErrorMessage('EBT096'));
                return redirect()->route('render-use-a01');
            }
            else {
                Session::flash('errorMessage', ErrorMessagesHelper::getErrorMessage('EBT093'));
                return redirect()->route('render-use-a01');
            }
        }
        else {
            \Illuminate\Support\Facades\Session::flash('errorMessage', '登録・更新・削除処理に失敗しました。');
            return redirect()->route('render-use-a01');
        }
    }
}
