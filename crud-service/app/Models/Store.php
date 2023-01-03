<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model {
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'address',
        'location',
        'latitude',
        'longitude',
        'start_time',
        'end_time',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function products() {
        return $this->hasMany(Product::class);
    }
}
