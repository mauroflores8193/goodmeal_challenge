<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class StoreResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'banner' => $this->banner,
            'icon' => $this->icon,
            'startTime' => Carbon::createFromFormat('H:i:s', $this->start_time)->format('H:i'),
            'endTime' => Carbon::createFromFormat('H:i:s', $this->end_time)->format('H:i'),
            'deliveryType' => "Retiro o delivery",
            'minPrice' => $this->getCheaperProduct()->price,
            'minOldPrice' => $this->getCheaperProduct()->old_price,
            'distanceTime' => 0,
            'distanceKm' => 0,
            'ordersCount' => 0,
            'isFavorite' => false,
            'score' => $this->score,
            'location' => $this->location,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
