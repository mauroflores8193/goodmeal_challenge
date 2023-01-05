<?php

namespace App\Http\Controllers;

use App\Http\Resources\StoreResource;
use App\Models\Store;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller {

    /**
     * @OA\Get(path="/api/stores",
     *     tags={"stores"},
     *     @OA\Response(response=200, description="Lista todas las tiendas con stock.")
     * )
     */
    public function index(): JsonResponse {
        $storesWithStock = Store::withStock()->select('stores.id')->distinct()->get();
        $ids = array_column($storesWithStock->toArray(), 'id');
        return response()->json(StoreResource::collection(Store::whereIn('id', $ids)->get()));
    }

    /**
     * @OA\Get(path="/api/stores/{id}",
     *     tags={"stores"},
     *     description="Envia como parámetro el ID de una tienda y le retorna sus datos",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          @OA\Schema(type="integer"),
     *          required=true,
     *          description="ID de la tienda",
     *      ),
     *     @OA\Response(response=200, description="Muestra datos de la tienda"),
     *     @OA\Response(response=404, description="Not Found")
     * )
     */
    public function show($id): JsonResponse {
        return response()->json(new StoreResource(Store::findOrFail($id)));
    }
}
