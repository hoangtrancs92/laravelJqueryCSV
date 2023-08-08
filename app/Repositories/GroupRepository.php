<?php

namespace App\Repositories;

use App\Models\Group;
use App\Repositories\Interfaces\GroupRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection\paginate;
use Illuminate\Support\Facades\DB;



class GroupRepository implements GroupRepositoryInterface
{
    protected $model;

    public function __construct(Group $model)
    {
        $this->model = $model;
    }

    public function getAllGroups()
    {
        $query = $this->model->query()->leftjoin('user', 'user.id', '=', 'group.group_leader_id')->orderBy('group.id', 'desc')->select('group.*', 'user.name as username', 'user.deleted_date as userdelete');
        return $query->paginate(10);
    }

    public function getIdGroups()
    {
        $results = $this->model->query()->select('id')->get();
        $userIds = $results->pluck('id')->all();
        return $userIds;
    }

    public function importCSV($condition)
    {
        DB::beginTransaction();
        $currentDate = Carbon::now();
        $dateWithoutTime = $currentDate->toDateString();
        foreach ($condition as $group) {
            try {
                if ($group['id'] === "" && $group['deleted_date'] !== "Y") {
                    Group::create([
                        'name' => $group['name'],
                        'note' => $group['note'],
                        'group_leader_id' => $group['group_leader_id'],
                        'group_floor_number' => $group['group_floor_number'],
                    ]);
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }

            if ($group['id'] != "" && $group['deleted_date'] === "Y") {
                $model = Group::find($group['id']);
                // $group['deleted_date'] = $dateWithoutTime;
                $model->delete($group);
            } else if ($group['id'] != "" && $group['deleted_date'] != "Y") {
                $model = Group::find($group['id']);
                $model->update([
                    'name' => $group['name'],
                    'note' => $group['note'],
                    'group_leader_id' => $group['group_leader_id'],
                    'group_floor_number' => $group['group_floor_number'],
                    'updated_date' => $dateWithoutTime
                ]);
            }
        }

        return null;
    }

    public function getListGroup() {
        $results = $this->model->query()->where('name', '!=', '')->where('deleted_date', '=', null)->orderBy('name', 'asc')->select('id','name')->get();
        $arrayOfArrays = $results->toArray();
        return $arrayOfArrays;
     }
}
