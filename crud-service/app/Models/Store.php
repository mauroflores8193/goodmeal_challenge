<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model {
    use SoftDeletes;
    protected $fillable = [
        'name',
        'address',
        'location',
        'lat',
        'lng',
        'start_time',
        'end_time',
        'user_id',
    ];
}
