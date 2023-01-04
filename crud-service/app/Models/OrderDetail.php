<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model {
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'amount',
        'price',
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function product() {
        return $this->hasMany(Product::class);
    }
}
