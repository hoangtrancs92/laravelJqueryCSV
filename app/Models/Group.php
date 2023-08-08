<?php

namespace App\Models;

use App\Helpers\CommonHelper;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ObserverTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Group extends Model
{
    use HasFactory, ObserverTrait;

    protected $table = 'group';
    protected $guarded = [];
    public $timestamps = false;

    public function createdDateAttribute(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $startedDate = $attributes['created_date'];
                $date = (new DateTime($startedDate))->format('d/m/Y');
                return $date;
            },
        );
    }

    public function updatedDateAttribute(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $updatedDate = $attributes['updated_date'];
                $date = (new DateTime($updatedDate))->format('d/m/Y');
                return $date;
            },
        );
    }

    public function deletedDateAttribute(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                if ($attributes['deleted_date']) {
                    $deletedDate = $attributes['deleted_date'];
                    $date = (new DateTime($deletedDate))->format('d/m/Y');
                    return $date;
                } else {
                    return null;
                }

            },
        );
    }

    public function noteAttribute(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $longText = new CommonHelper();
                return $longText->formatString($attributes['note']);
            },
        );
    }

    public function convertGroupNameAttribute(): Attribute
    {
        return Attribute::make(
            get: function ( $value, $attributes) {
              $longText = new CommonHelper();
              return $longText->longTextToThreeDots($attributes['name'], 20);
            },
        );
    }

    public function convertGroupLeaderAttribute(): Attribute
    {
        return Attribute::make(
            get: function ( $value, $attributes) {
              $longText = new CommonHelper();
              if($attributes['userdelete'] == null)
              {
                return $longText->longTextToThreeDots($attributes['username'], 20);
              }
              else {
                return "";
              }
            },
        );
    }
}
