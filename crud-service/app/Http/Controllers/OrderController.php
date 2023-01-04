<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller {

    public function index(): JsonResponse {
        return response()->json(OrderResource::collection(Order::all()));
    }

    public function show($id): JsonResponse {
        return response()->json(new OrderResource(Order::findOrFail($id)));
    }
}
