<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

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

    public function getDiscountAttribute() {
        return round(100 * $this->price / $this->old_price);
    }

    public function scopeWithStock($query) {
        return $query->where('amount', '>', 0);
    }

    public function getImageUrl() {
        if (array_key_exists('host', parse_url($this->image))) {
            return $this->image;
        } else {
            return Storage::disk('public')->url('uploads/'. $this->image);
        }
    }
}
