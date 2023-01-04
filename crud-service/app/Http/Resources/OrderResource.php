<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class OrderResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'storeName' => $this->storeName,
            'storeAddress' => $this->storeAddress,
            'shippingCost' => $this->shipping_cost,
            'total' => $this->total,
            'deliveryDate' => Carbon::createFromFormat('Y-m-d', $this->delivery_date)->format('d/m/Y'),
            'deliveryStarTime' => Carbon::createFromFormat('H:i:s', $this->deliveryStarTime)->format('H:i'),
            'deliveryEndTime' => Carbon::createFromFormat('H:i:s', $this->deliveryEndTime)->format('H:i'),
            'details' => OrderDetailResource::collection($this->details),
        ];
    }
}
