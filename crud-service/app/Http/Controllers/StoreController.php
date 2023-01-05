<?php

namespace App\Http\Controllers;

use App\Http\Resources\StoreResource;
use App\Models\Store;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Info(title="API Usuarios", version="1.0")
 *
 * @OA\Server(url="http://localhost:8000")
 */
class StoreController extends Controller {

    /**
     * @OA\Get(
     *     path="/api/stores",
     *     summary="Listar tiendas",
     *     @OA\Response(
     *         response=200,
     *         description="Mostrar todas las tiendas."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function index(): JsonResponse {
        $storesWithStock = Store::withStock()->select('stores.id')->distinct()->get();
        $ids = array_column($storesWithStock->toArray(), 'id');
        return response()->json(StoreResource::collection(Store::whereIn('id', $ids)->get()));
    }

    public function show($id): JsonResponse {
        return response()->json(new StoreResource(Store::findOrFail($id)));
    }
}
