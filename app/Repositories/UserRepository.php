<?php

namespace App\Repositories;

use App\Enums\DeleteEnum;
use App\Enums\UserRoleEnum;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection\paginate;
use Illuminate\Support\Facades\Session;
use App\Models\User;


class UserRepository implements UserRepositoryInterface
{
    protected $AVAILBLE_USER = null;
    protected $DIRECTOR = UserRoleEnum::DIRECTOR->value;
    protected $LEADER = UserRoleEnum::LEADER->value;
    protected $GROUP_LEADER = UserRoleEnum::GROUP_LEADER->value;
    protected $MEMBER = UserRoleEnum::MEMBER->value;
    protected $model;

    public function __construct(User $model, )
    {
        $this->model = $model;
    }

    public function getAllUsers()
    {
        $query = $this->model->query()->where('deleted_date', '=', $this->AVAILBLE_USER)->whereIn('position_id', [$this->DIRECTOR, $this->LEADER, $this->GROUP_LEADER, $this->MEMBER]);
        return $query->paginate(10);
    }

    public function getUserById($userId)
    {
        $count = $this->model->where('id', $userId)->where('deleted_date', '=', null)->count();
        if($count == 1)
        {
            return true;
        }
        else {
            return false;
        }
    }

    public function getUserByEmail($userEmail)
    {
        $query = $this->model->query();
        $count = $query->where('email', $userEmail)->where('deleted_date', '=', null)->count();
        if($count > 1)
        {
            return false;
        }
        else if($count == 1) {
            $result = $this->model->query()->where('email', $userEmail)->where('deleted_date', '=', null)->first();
            return $result;
        }

    }

    public function deleteUser($userId)
    {

    }

    public function createUser(array $userDetails)
    {
        return User::create($userDetails);
    }

    public function searchUserA01($request)
    {
        session()->flashInput($request->all());
        Session::put('condition', $request->all());
        $query = $this->model->query()->leftjoin('group', 'user.group_id', '=', 'group.id')
            ->whereNull('user.deleted_date')
            ->select('user.*');
        if ($request->name) {
            $query->where('user.name', 'like', '%' . $request->name . '%');
        }
        if ($request->startDateFrom != null && $request->startDateTo == null) {
            $query->whereDate('user.created_date', '>=', $request->startDateFrom);
        }

        if ($request->startDateFrom == null && $request->startDateTo != null) {
            $query->whereDate('user.created_date', '<=', $request->startDateTo);
        }

        if ($request->startDateFrom != null && $request->startDateTo != null) {
            $query->whereDate('user.created_date', '>=', $request->startDateFrom)->whereDate('user.created_date', '<=', $request->startDateTo);
        }

        $query->orderBy('user.name', 'asc')->orderBy('user.started_date', 'asc')->orderBy('user.id', 'asc');

        $result = $query->select(['user.id', 'user.name', 'user.email', 'group.name as groupName', 'user.started_date', 'user.position_id'])->paginate(10);
        return $result;
    }

    public function csvExportA01($request)
    {
        $startDateFrom = $request['startDateFrom'] ?? '';
        $startDateTo = $request['startDateTo'] ?? '';
        $query = $this->model->query()->leftjoin('group', 'user.group_id', '=', 'group.id')
            ->whereNull('user.deleted_date')
            ->select('user.*');
        if ($request['name']) {
            $query->where('user.name', 'like', '%' . $request['name'] . '%');
        }
        if ($startDateFrom != null && $startDateTo == null) {
            $query->whereDate('user.created_date', '>=', $request['startDateFrom']);
        }

        if ($startDateFrom == null && $startDateTo != null) {
            $query->whereDate('user.created_date', '<=', $startDateTo);
        }

        if ($startDateFrom != null && $startDateTo != null) {
            $query->whereDate('user.created_date', '>=', $startDateFrom)->whereDate('user.created_date', '<=', $startDateTo);
        }

        $query->orderBy('user.name', 'asc')->orderBy('user.started_date', 'asc')->orderBy('user.id', 'asc');

        $result = $query->select([
            'user.id',
            'user.name',
            'user.email',
            'user.group_id',
            'group.name as groupName',
            'user.started_date',
            'user.position_id',
            'user.created_date',
            'user.updated_date'
        ])->get();
        return $result;
    }

    public function getListPosition()
    {
        $result = $this->model->query()->whereIn('position_id', [$this->DIRECTOR, $this->MEMBER, $this->LEADER, $this->GROUP_LEADER])->get();
        return $result;
    }

    public function getInfoUser($id)
    {
        $result = User::query()
            ->leftJoin('group', 'user.group_id', '=', 'group.id')
            ->select('user.*', 'group.name as groupName', 'group.id as groupId')
            ->where('user.id', $id)
            ->first();
        $result = (object) $result;
        return $result;
    }

    public function createUserA02($request)
    {
        try {
            User::create($request);
            return true;
        } catch (\Exception $e) {
            return false;
        }

    }
    public function updateUserA02($request, $id)
    {
        $user = User::find($id);
        $emailUpdate = User::where('email', $request['email'])->first();
        if($emailUpdate == null)
        {
            $emailUpdate['email'] = null;
        }

        if( ($user->email != $emailUpdate['email'] && isset($emailUpdate['email']) == null) || $user->email === $emailUpdate['email'])
        {
            if(!$user) {
                return false;
            }
            else {
                if($request['password'] == "")
                {
                    $data = [
                        'name' => $request['name'],
                        'email' => $request['email'],
                        'group_id' => $request['group_id'],
                        'position_id' => $request['position_id'],
                        'started_date' => $request['started_date'],
                    ];
                    $user->update($data);
                    return true;
                }
                else
                {
                    $user->update($request);
                    return true;
                }
            }
        }
        else {
            return ['duplicated' => true];
        }

    }

    public function updatePasswordUserA02($request, $id)
    {
        $user = User::find($id);
        if(!$user) {
            return false;
        }
        else {
            if($request['password'] == null)
            {
                return true;
            }
            else {
                $user->update($request);
                return true;
            }
        }
    }

    public function deleteUserA02($id) {
        $user = User::find($id);
        if(!$user) {
            return false;
        }
        else {
            $user->delete();
            return true;
        }
    }
}
