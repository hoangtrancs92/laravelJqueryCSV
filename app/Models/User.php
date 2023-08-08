<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRoleEnum;
use App\Helpers\CommonHelper;
use App\Traits\ObserverTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DateTime;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasFactory, Notifiable, ObserverTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'user';
    protected $guarded = [];
    protected $fillable = [
        'name',
        'email',
        'password',
        'group_id',
        'position_id',
        'started_date'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public $timestamps = false;

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    protected function positionIdAttribute(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $position_id = $attributes['position_id'];
                if ($position_id === UserRoleEnum::DIRECTOR->value) {
                    return 'Director';
                } else if ($position_id === UserRoleEnum::GROUP_LEADER->value) {
                    return 'Group Leader';
                } else if ($position_id === UserRoleEnum::LEADER->value) {
                    return 'Leader';
                } else if ($position_id === UserRoleEnum::MEMBER->value) {
                    return 'Member';
                }
                else {
                    return '';
                }
            },
        );
    }

    public function startedDateAttributeYmd(): Attribute
    {
        return Attribute::make(
            get: function ( $value, $attributes) {
                $date_of_birth = $attributes['started_date'];
                $date = (new DateTime($date_of_birth))->format('d/m/Y');
                return $date;
            },
        );
    }

    public function startedDateAttributeDmy(): Attribute
    {
        return Attribute::make(
            get: function ( $value, $attributes) {
                $date_of_birth = $attributes['started_date'];
                $date = (new DateTime($date_of_birth))->format('d/m/Y');
                return $date;
            },
        );
    }

    public function converEmailAttribute(): Attribute
    {
        return Attribute::make(
            get: function ( $value, $attributes) {
              $longText = new CommonHelper();
              return $longText->longTextToThreeDots($attributes['email'], 30);
            },
        );
    }

    public function convertNameAttribute(): Attribute
    {
        return Attribute::make(
            get: function ( $value, $attributes) {
              $longText = new CommonHelper();
              return $longText->longTextToThreeDots($attributes['name'], 20);
            },
        );
    }

    public function convertGroupNameAttribute(): Attribute
    {
        return Attribute::make(
            get: function ( $value, $attributes) {
              $longText = new CommonHelper();
              return $longText->longTextToThreeDots($attributes['groupName'], 20);
            },
        );
    }

}

