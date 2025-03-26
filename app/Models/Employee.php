<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
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
