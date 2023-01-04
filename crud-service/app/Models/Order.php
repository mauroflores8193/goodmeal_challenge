<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model {
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'store_id',
        'user_id',
        'delivery_type',
        'delivery_date',
        'shipping_cost',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function store() {
        return $this->belongsTo(Store::class);
    }

    public function details() {
        return $this->hasMany(OrderDetail::class);
    }

    public function getStoreNameAttribute() {
        return $this->store->name;
    }


    public function getStoreAddressAttribute() {
        return $this->store->address;
    }

    public function getTotalAttribute() {
        $total = 0;
        foreach ($this->details as $detail) {
            $total += $detail->total;
        }
        return $total;
    }

    public function getDeliveryStarTimeAttribute() {
        return $this->store->start_time;
    }

    public function getDeliveryEndTimeAttribute() {
        return $this->store->end_time;
    }
}
