<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'admin';

    protected $fillable = [
        'firstName',
        'lastName',
        'companyName',
        'email',
        'password',
        'phone',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
