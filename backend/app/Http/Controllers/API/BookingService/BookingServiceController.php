<?php

namespace App\Http\Controllers\API\BookingService;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BookingServiceResource;
use App\Models\BookingService;

class BookingServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string|int $id)
    {
    
        $bookingServices = BookingService::where('booking_id', $id)->get();
        return response()->json([
            "success" => true,
            "data" => BookingServiceResource::collection($bookingServices)
        ], 200);
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
    public function delete(string $id)
    {
        //
        $bookingService = BookingService::find($id);
        $bookingService->delete();
        return response()->json([
            "success" => true,
            "message" => "Booking Service deleted successfully"
        ], 200);
    }
}
