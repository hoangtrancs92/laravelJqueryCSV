<?php

namespace App\Observers;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ModelObserver
{

    public function creating(Model $model)
    {
        $currentDate = Carbon::now();
        $dateWithoutTime = $currentDate->toDateString();
        $model->created_date = $dateWithoutTime;
        $model->updated_date = $dateWithoutTime;
    }

    public function updating(Model $model)
    {
        $currentDate = Carbon::now();
        $dateWithoutTime = $currentDate->toDateString();
        $model->updated_date = $dateWithoutTime;
    }

    public function deleting(Model $model)
    {
        $currentDate = Carbon::now();
        $dateWithoutTime = $currentDate->toDateString();
        $model->deleted_date = $dateWithoutTime;
        $model->save();
        return false;
    }
}
