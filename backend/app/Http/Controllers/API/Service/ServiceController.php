<?php

namespace App\Http\Controllers\APi\Service;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $services = Service::where('store_id', $user->store_id)->get();
        $services = ServiceResource::collection($services);
        return response()->json([
            'success' => true,
            'data' => $services,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_name'     => 'required|string|max:255|unique:services',
            'description'  => 'required|string',
            
            'category_id'  => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $user = Auth::user();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/ServiceImages');
            $serviceImage = Storage::url($path);
        } else {
            $serviceImage = null;
        }

        $service = Service::create([
            'service_name' => $request->service_name,
            'description' => $request->description,
            'duration' => $request->duration,
            'price' => $request->price,
            'store_id' => $user->store_id,
            'discount' => $request->discount,
            'image' => $serviceImage,
            'category_id' => $request->category_id
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Province created successfully',
            'data' => $service,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Service::find($id);
        return response()->json([
            'success' => true,
            'data' => $service,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'service_name' => 'required|string|max:255|unique:services,service_name,' . $id,
            'category_id' => 'required|integer|exists:categories,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $service = Service::find($id);

        if (!$service) {
            return response()->json(['error' => 'Service not found'], 404);
        }

        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::delete($service->image);
            }
            $path = $request->file('image')->store('public/ServiceImages');
            $serviceImage = Storage::url($path);
        } else {
            $serviceImage = $service->image;
        }

        $service->update([
            'service_name' => $request->service_name,
            'description' => $request->description,
            'duration' => $request->duration,
            'price' => $request->price,
            'discount' => $request->discount,
            'image' => $serviceImage,
            'category_id' => $request->category_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Service updated successfully',
            'data' => $service,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::find($id);
        $service->delete();
        return response()->json([
            'success' => true,
            'message' => 'Service deleted successfully',
        ]);
    }

    public function GetServiceByStoreId(string $id)
    {
        $services = Service::where('store_id', $id)->get();
        $services = ServiceResource::collection($services);
        return response()->json([
            'success' => true,
            'message' => 'Service by store id',
            'data' => $services,
        ]);
    }
}
