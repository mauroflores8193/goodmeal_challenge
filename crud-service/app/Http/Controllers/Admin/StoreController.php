<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StoreController extends Controller {

    /**
     * @OA\Get(path="/api/admin/stores",
     *     security={ {"sanctum": {} }},
     *     tags={"Listar tiendas (Usuarios autorizados)"},
     *     @OA\Response(response=200, description="Lista todas las tiendas."),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function index(): JsonResponse {
        return response()->json(Store::all());
    }

    public function store(Request $request): JsonResponse {
        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'location' => 'required',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s'
        ]);
        $request->validate([
            'icon' => 'required|max:500',
            'banner' => 'required|max:500'
        ]);
        $data['user_id'] = $request->user()->id;
        if ($request->hasFile('icon')) $data['icon'] = $this->uploadFile($request->file('icon'));
        if ($request->hasFile('banner')) $data['banner'] = $this->uploadFile($request->file('banner'));
        return response()->json(Store::create($data), 201);
    }

    private function uploadFile($requestFile): string {
        $fileName = Str::uuid()->toString() . '.' . $requestFile->getClientOriginalExtension();
        $requestFile->storeAs('uploads', $fileName, 'public');
        return $fileName;
    }

    /**
     * @OA\Get(path="/api/admin/stores/{id}",
     *     security={ {"sanctum": {} }},
     *     tags={"Mostrar datos de una tienda (Usuarios autorizados)"},
     *     description="Envia como parámetro el ID de una tienda y le retorna sus datos. El usuario autorizado tiene que ser el creador de la tienda",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          @OA\Schema(type="integer"),
     *          required=true,
     *          description="ID de la tienda",
     *      ),
     *     @OA\Response(response=200, description="Muestra datos de la tienda"),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=403, description="Forbidden"),
     *     @OA\Response(response=404, description="Not Found")
     * )
     */
    public function show($id): JsonResponse {
        $store = Store::findOrFail($id);
        $this->authorize('view', $store);
        return response()->json($store);
    }

    public function update(Request $request, $id): JsonResponse {
        $this->authorize('update', Store::findOrFail($id));
        $request->validate([
            'latitude' => 'numeric|between:-90,90',
            'longitude' => 'numeric|between:-180,180',
            'start_time' => 'date_format:H:i:s',
            'end_time' => 'date_format:H:i:s',
            'icon' => 'max:500',
            'banner' => 'max:500'
        ]);
        $data = $request->all();
        if ($request->hasFile('icon')) $data['icon'] = $this->uploadFile($request->file('icon'));
        if ($request->hasFile('banner')) $data['banner'] = $this->uploadFile($request->file('banner'));
        Store::where('id', $id)->update($data);
        return response()->json(null, 204);
    }

    /**
     * @OA\Delete(path="/api/admin/stores/{id}",
     *     security={ {"sanctum": {} }},
     *     tags={"Eliminar datos de una tienda (Usuarios autorizados)"},
     *     description="Envia como parámetro el ID de una tienda y se eliminan los datos. El usuario autorizado tiene que ser el creador de la tienda",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          @OA\Schema(type="integer"),
     *          required=true,
     *          description="ID de la tienda",
     *      ),
     *     @OA\Response(response=204, description="Not Content"),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=403, description="Forbidden"),
     *     @OA\Response(response=404, description="Not Found")
     * )
     */
    public function destroy($id): JsonResponse {
        $store = Store::findOrFail($id);
        $this->authorize('delete', $store);
        $store->delete();
        return response()->json(null, 204);
    }
}
