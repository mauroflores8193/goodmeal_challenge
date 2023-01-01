<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller {

    public function index(): JsonResponse {
        return response()->json(Product::all());
    }

    public function product(Request $request): JsonResponse {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required',
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
        if($request->hasFile('image')) $data['image'] = $this->uploadFile($request->file('image'));
        return response()->json(Product::create($data), 201);
    }

    private function uploadFile($requestFile): string {
        $fileName = Str::uuid()->toString() . '.' . $requestFile->getClientOriginalExtension();
        $requestFile->productAs('uploads', $fileName, 'public');
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
            'latitude' => 'numeric|between:-90,90',
            'longitude' => 'numeric|between:-180,180',
            'start_time' => 'date_format:H:i:s',
            'end_time' => 'date_format:H:i:s',
            'icon' => 'max:500',
            'banner' => 'max:500'
        ]);
        $data = $request->all();
        if($request->hasFile('icon')) $data['icon'] = $this->uploadFile($request->file('icon'));
        if($request->hasFile('banner')) $data['banner'] = $this->uploadFile($request->file('banner'));
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
