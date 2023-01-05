<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller {

    /**
     * @OA\Get(path="/api/admin/stores/{storeId}/products",
     *     security={ {"sanctum": {} }},
     *     @OA\Parameter(
     *          name="storeId",
     *          in="path",
     *          @OA\Schema(type="integer"),
     *          required=true,
     *          description="ID de la tienda",
     *          example=1
     *      ),
     *     tags={"admin/products"},
     *     @OA\Response(response=200, description="Lista todos los productos."),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function index(): JsonResponse {
        return response()->json(Product::all());
    }

    /**
     * @OA\Post(path="/api/admin/stores/{storeId}/products",
     *     description="Envia como parámetro el ID de una tienda. El usuario autorizado tiene que ser el creador de la tienda",
     *     security={ {"sanctum": {} }},
     *     @OA\Parameter(
     *          name="storeId",
     *          in="path",
     *          @OA\Schema(type="integer"),
     *          required=true,
     *          description="ID de la tienda",
     *          example=46
     *      ),
     *     tags={"admin/products"},
     *     @OA\MediaType(mediaType="multipart/form-data"),
     *     @OA\RequestBody(
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *               type="object",
     *               required={"name", "price", "old_price", "amount", "image"},
     *               @OA\Property(property="name", type="string", example="Producto 1"),
     *               @OA\Property(property="price", type="number", example="100"),
     *               @OA\Property(property="old_price", type="number", example="150"),
     *               @OA\Property(property="amount", type="integer", example="10"),
     *               @OA\Property(property="image", type="file")
     *           ),
     *       )
     *     ),
     *     @OA\Response(response=201, description="Datos del producto creado"),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function store(Request $request, $store_id): JsonResponse {
        $store = Store::findOrFail($store_id);
        if($store->user_id !== $request->user()->id) abort(403);
        $data = $request->validate([
            'name' => 'required',
            'old_price' => 'required|numeric',
            'price' => 'required|numeric',
            'amount' => 'required|numeric'
        ]);
        $request->validate([
            'image' => 'required|max:500'
        ]);
        $data['user_id'] = $request->user()->id;
        if($request->hasFile('image')) {
            $data['image'] = $this->uploadFile($request->file('image'));
        }
        return response()->json($store->products()->create($data), 201);
    }

    private function uploadFile($requestFile): string {
        $fileName = Str::uuid()->toString() . '.' . $requestFile->getClientOriginalExtension();
        $requestFile->storeAs('uploads', $fileName, 'public');
        return $fileName;
    }

    /**
     * @OA\Get(path="/api/admin/products/{id}",
     *     security={ {"sanctum": {} }},
     *     tags={"admin/products"},
     *     description="Envia como parámetro el ID de un producto y le retorna sus datos. El usuario autorizado tiene que ser el creador del producto",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          @OA\Schema(type="integer"),
     *          required=true,
     *          description="ID del producto",
     *      ),
     *     @OA\Response(response=200, description="Muestra datos del producto"),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=403, description="Forbidden"),
     *     @OA\Response(response=404, description="Not Found")
     * )
     */
    public function show($id): JsonResponse {
        $product = Product::findOrFail($id);
        $this->authorize('view', $product);
        return response()->json($product);
    }

    /**
     * @OA\Put(path="/api/admin/products/{id}",
     *     security={ {"sanctum": {} }},
     *     tags={"admin/products"},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          @OA\Schema(type="integer"),
     *          required=true,
     *          description="ID del producto",
     *      ),
     *     @OA\MediaType(mediaType="multipart/form-data"),
     *     @OA\RequestBody(
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(property="name", type="string", example="Otro nombre"),
     *               @OA\Property(property="price", type="number", example="25"),
     *               @OA\Property(property="old_price", type="number", example="30"),
     *               @OA\Property(property="amount", type="integer", example="1"),
     *               @OA\Property(property="image", type="file")
     *           ),
     *       )
     *     ),
     *     @OA\Response(response=204, description="Not content"),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function update(Request $request, $id): JsonResponse {
        $this->authorize('update', Product::findOrFail($id));
        $request->validate([
            'old_price' => 'numeric',
            'price' => 'numeric',
            'amount' => 'numeric'
        ]);
        $data = $request->all();
        if($request->hasFile('image')) $data['image'] = $this->uploadFile($request->file('image'));
        Product::where('id', $id)->update($data);
        return response()->json(null, 204);
    }

    /**
     * @OA\Delete(path="/api/admin/products/{id}",
     *     security={ {"sanctum": {} }},
     *     tags={"admin/products"},
     *     description="Envia como parámetro el ID de un producto y se eliminan los datos. El usuario autorizado tiene que ser el creador del producto",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          @OA\Schema(type="integer"),
     *          required=true,
     *          description="ID del producto",
     *      ),
     *     @OA\Response(response=204, description="Not Content"),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=403, description="Forbidden"),
     *     @OA\Response(response=404, description="Not Found")
     * )
     */
    public function destroy($id): JsonResponse {
        $product = Product::findOrFail($id);
        $this->authorize('delete', $product);
        $product->delete();
        return response()->json(null, 204);
    }
}
