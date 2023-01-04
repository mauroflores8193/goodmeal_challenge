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

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function isFavorite() {
        return rand(0,1) == 1;
    }

    public function getDistanceTime() {
        return rand(1, 45);
    }

    public function getDistanceKm() {
        return rand(5, 60) / 10;
    }

    public function scopeWithStock($query) {
        return $query->join('products', function ($join) {
            $join->on('stores.id', '=', 'products.store_id')->where('products.amount', '>', 0);
        });
    }

    public function getCheaperProduct() {
        return $this->products()->where('amount', '>', 0)->orderBy('price')->first();
    }
}
