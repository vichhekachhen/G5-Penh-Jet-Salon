<?php

namespace App\Http\Controllers\API\Store;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = Store::all();
        $stores = StoreResource::collection($stores);
        return response()->json([
            'success' => true,
            'message' => 'All stores',
            'data' => $stores,
        ]);
    }
    // public function StoreByProvince()
    // {
    //     $stores = Store::all();
    //     $stores = StoreResource::collection($stores);
    //     $stores = JSON.parse( $stores );
    //     $dataArray = json_decode($stores, true);
    //     $stores = $dataArray['data'];

    //     $groupedByProvince = [];

    //     foreach ($stores as $store) {
    //         $provinceName = $store['address']['province']['province_name'];
    //         if (!isset($groupedByProvince[$provinceName])) {
    //             $groupedByProvince[$provinceName] = [];
    //         }
    //         $groupedByProvince[$provinceName][] = $store;
    //     }
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Store by province name',
    //         'data' => $groupedByProvince,
    //     ]);
    // }

    public function StoreByProvince()
    {
        $stores = StoreResource::collection(Store::all());
        $storesArray = $stores->toArray(request());
        // Initialize the array to group stores by province
        $groupedByProvince = [];

        // Iterate through each store and group them by province name
        foreach ($storesArray as $store) {
            $provinceName = $store['address']['province']['province_name'];
            if (!isset($groupedByProvince[$provinceName])) {
                $groupedByProvince[$provinceName] = [];
            }
            $groupedByProvince[$provinceName][] = $store;
        }

        // Return the response as a JSON object
        return response()->json([
            'success' => true,
            'message' => 'Store by province name',
            'data' => $groupedByProvince,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
