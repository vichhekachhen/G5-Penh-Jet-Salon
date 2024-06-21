<?php

namespace App\Http\Controllers\APi\Service;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return response()->json([
            'success'=> true,
            'data' => $services,
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_name'     => 'required|string|max:255',
            'description'  => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $user = Auth::user();

        $service = Service::create([
            'service_name' => $request->service_name,
            'description' => $request->description,
            'duration' => $request->duration,
            'price' => $request->price,
            'store_id' => $user->store_id
        ]);
        return response()->json([
            'success'=> true,
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
            'success'=> true,
            'data' => $service,
      ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'service_name'     => 'string|max:255',
            'description'  => 'string',
            'duration'  => 'integer',
            'price'  => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $service = Service::find($id);
        $service->update(
            [
                'service_name' => $request->service_name,
                'description' => $request->description ? : null,
                'duration' => $request->duration,
                'price' => $request->price,

            ]
        );

        return response()->json([
            'success'=> true,
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
            'success'=> true,
            'message' => 'Service deleted successfully',
      ]);
    }
}
