<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StoreController extends Controller {

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
        if($request->hasFile('icon')) $data['icon'] = $this->uploadFile($request->file('icon'));
        if($request->hasFile('banner')) $data['banner'] = $this->uploadFile($request->file('banner'));
        return response()->json(Store::create($data), 201);
    }

    private function uploadFile($requestFile): string {
        $fileName = Str::uuid()->toString() . '.' . $requestFile->getClientOriginalExtension();
        $requestFile->storeAs('uploads', $fileName, 'public');
        return $fileName;
    }

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
        if($request->hasFile('icon')) $data['icon'] = $this->uploadFile($request->file('icon'));
        if($request->hasFile('banner')) $data['banner'] = $this->uploadFile($request->file('banner'));
        Store::where('id', $id)->update($data);
        return response()->json(null, 204);
    }

    public function destroy($id): JsonResponse {
        $store = Store::findOrFail($id);
        $this->authorize('delete', $store);
        if ($store->icon) Storage::disk('public')->delete("uploads/{$store->icon}");
        if ($store->banner) Storage::disk('public')->delete("uploads/{$store->banner}");
        $store->delete();
        return response()->json(null, 204);
    }
}
