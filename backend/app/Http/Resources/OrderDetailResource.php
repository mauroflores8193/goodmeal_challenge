<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class OrderDetailResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'name' => $this->name,
            'total' => $this->total,
        ];
    }
}
