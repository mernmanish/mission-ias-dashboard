<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory,HasApiTokens,Notifiable;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'city',
        'image_link',
        'password',
        'api_token',
        'fcm_token',
        'join_date',
        'status',
        'is_login'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
}
