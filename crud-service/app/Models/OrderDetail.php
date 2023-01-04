<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model {
    use HasFactory;

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
        return $this->belongsTo(Product::class);
    }

    public function getNameAttribute() {
        return $this->product->name;
    }

    public function getTotalAttribute() {
        return $this->amount * $this->price;
    }
}
