<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    
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
}
