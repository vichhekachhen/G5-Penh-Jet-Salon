<?php

namespace App\Http\Controllers\API\BookingService;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\bookingServiesResource;

use App\Models\BookingService;

class BookingServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getBookingService(string $id)
    {
        //
        $bookingServices = BookingService::where('service_id', $id)->get();
        return response()->json([
            "success" => true,
            "data" => bookingServiesResource::collection($bookingServices)
        ],200);
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
