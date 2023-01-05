<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class StoreResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'banner' => $this->getBannerUrl(),
            'icon' => $this->getIconUrl(),
            'startTime' => Carbon::createFromFormat('H:i:s', $this->start_time)->format('H:i'),
            'endTime' => Carbon::createFromFormat('H:i:s', $this->end_time)->format('H:i'),
            'deliveryType' => "Retiro o delivery",
            'minPrice' => $this->getCheaperProduct() ? $this->getCheaperProduct()->price : null,
            'minOldPrice' => $this->getCheaperProduct() ? $this->getCheaperProduct()->old_price: null,
            'distanceTime' => $this->getDistanceTime(),
            'distanceKm' => $this->getDistanceKm(),
            'ordersCount' => $this->orders()->count(),
            'isFavorite' => $this->isFavorite(),
            'score' => $this->score,
            'location' => $this->location,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'products' => ProductResource::collection($this->products()->withStock()->get())
        ];
    }
}
