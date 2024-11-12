<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';


    protected $guarded = [];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hisRole(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Role::class, 'role');
    }
    public function photoLink()
    {
        $image = asset('AdminAssets/app-assets/images/portrait/small/avatar-s-11.jpg');

        if ($this->profile_photo != '') {
            $image = asset('uploads/users/' . $this->id . '/' . $this->profile_photo);
        }

        return $image;
    }

    public function checkActive()
    {
        $active = '1';
        if ($this->active == '0') {
            $active = trans('auth.yourAcountStillNotActive');
        }
        if ($this->block == '1') {
            $active = trans('auth.yourAcountIsBlocked');
        }
        return $active;
    }





   }
