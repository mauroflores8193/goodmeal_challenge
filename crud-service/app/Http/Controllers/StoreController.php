<?php

namespace App\Http\Controllers;

use App\Http\Resources\StoreResource;
use App\Models\Store;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller {

    public function index(): JsonResponse {
        $storesWithStock = Store::withStock()->select('stores.id')->distinct()->get();
        $ids = array_column($storesWithStock->toArray(), 'id');
        return response()->json(StoreResource::collection(Store::whereIn('id', $ids)->get()));
    }

    public function show($id): JsonResponse {
        return response()->json(new StoreResource(Store::findOrFail($id)));
    }
}
