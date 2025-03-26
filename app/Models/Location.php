<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'location';

    protected $fillable = [
        'id',
        'locationName',
        'shortName',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'status'
    ];
}
