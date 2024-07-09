<?php

namespace App\Http\Controllers\API\Booking;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingService;
use App\Models\CardItem;
use App\Models\Service;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $pre_bookings = CardItem::where("user_id", $user->id)->get();
        if (count($pre_bookings) <= 0) {
            return response()->json([
                "success" => false,
                "message" => "Don't have pre_booking" 
            ]);
        }

        $store_id = null;
        $total_price = 0;
        $booking = Booking::create([
            "user_id" => $user->id,
            "store_id" => $store_id, 
            "total_price" => $total_price,
            "date" => $request->date,
            "time" => $request->time,
            "pay" => $request->pay,
            "indebte" => $request->indebte
        ]);
        //delete pre_bookings
        foreach ($pre_bookings as $pre_booking) {
            //prevent delete of pre_bookings of this user
            if ($booking) {
                $cardItem = CardItem::find($pre_booking->id);
                $cardItem->delete();
            }

            $service = Service::find($pre_booking->service_id);

            if ($service) {
                $store_id = $service->store_id;
                $total_price += $service->price;
                BookingService::create([
                    "booking_id" => $booking->id,
                    "service_id" => $pre_booking->service_id,
                ]);
            }
        }

        if (abs($booking->pay - (float) $total_price) < 0.01) {
            $booking->status = "done";
        }else{
            $inbete = (float)$total_price - $booking->pay;
            $booking->indebte = $inbete;
        }
        // Update the Booking with store_id and total_price
        $booking->store_id = $store_id;
        $booking->total_price = $total_price;
        $booking->save();
        // Refresh the booking model instance to reflect changes made in database
        $booking->refresh();
        return response()->json([
            'success' => true,
            'message' => 'Booking successfully created!',
            'result' => $booking,
        ]);
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
