<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->getImageUrl(),
            'price' => $this->price,
            'discount' => $this->discount,
            'oldPrice' => $this->old_price,
            'stock' => $this->amount,
        ];
    }
}
