<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $table = 'employee';

    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
        'phone',
        'dateOfBirth',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'status'
    ];
}
