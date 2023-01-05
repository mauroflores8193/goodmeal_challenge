<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller {

    /**
     * @OA\Get(path="/api/orders",
     *     tags={"Listar órdenes"},
     *     @OA\Response(response=200, description="Lista todas las órdenes."),
     *     @OA\Response(response="default", description="Ha ocurrido un error.")
     * )
     */
    public function index(): JsonResponse {
        return response()->json(OrderResource::collection(Order::orderBy('id', 'DESC')->get()));
    }

    /**
     * @OA\Get(path="/api/orders/{id}",
     *     tags={"Mostrar datos de una órden"},
     *     description="Envia como parámetro el ID de una órden y le retorna sus datos",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          @OA\Schema(type="integer"),
     *          required=true,
     *          description="ID de la órden a consultar",
     *      ),
     *     @OA\Response(response=200, description="Muestra datos de la órden"),
     *     @OA\Response(response=404, description="Not Found")
     * )
     */
    public function show($id): JsonResponse {
        return response()->json(new OrderResource(Order::findOrFail($id)));
    }
}
