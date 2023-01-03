<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model {
    use SoftDeletes, HasFactory;

    public function store() {
        return $this->belongsTo(Store::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'name',
        'price',
        'old_price',
        'amount',
        'image',
        'store_id',
        'user_id',
    ];
}
