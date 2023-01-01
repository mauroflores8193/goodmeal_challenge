<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller {

    public function index(): JsonResponse {
        return response()->json(Product::all());
    }

    public function store(Request $request, $store_id): JsonResponse {
        $store = Store::findOrFail($store_id);
        if($store->user_id !== $request->user()->id) abort(403);
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'discount' => 'numeric|between:0,100',
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

    public function show($id): JsonResponse {
        $product = Product::findOrFail($id);
        $this->authorize('view', $product);
        return response()->json($product);
    }

    public function update(Request $request, $id): JsonResponse {
        $this->authorize('update', Product::findOrFail($id));
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'discount' => 'numeric|between:0,100',
            'amount' => 'required|numeric'
        ]);
        $data = $request->all();
        if($request->hasFile('image')) $data['image'] = $this->uploadFile($request->file('image'));
        Product::where('id', $id)->update($data);
        return response()->json(null, 204);
    }

    public function destroy($id): JsonResponse {
        $product = Product::findOrFail($id);
        $this->authorize('delete', $product);
        if ($product->image) Storage::disk('public')->delete("uploads/{$product->image}");
        $product->delete();
        return response()->json(null, 204);
    }
}
