<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function scopeWithStock($query) {
        return $query->join('products', function ($join) {
            $join->on('stores.id', '=', 'products.store_id')->where('products.amount', '>', 0);
        });
    }

    public function getCheaperProduct() {
        return $this->products()->orderBy('price')->first();
    }
}
