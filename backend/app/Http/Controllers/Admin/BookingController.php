<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\bookingResource;
use App\Models\BookingService;
use App\Models\Service;
use App\Models\User;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('role_or_permission:Booking access|Booking create|Booking edit|Booking delete', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:Booking create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:Booking edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:Booking delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userAuth = Auth::user();
        $bookings = Booking::where('store_id', $userAuth->store_id)->paginate(10);
        return view('booking.index', compact('bookings'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Booking $booking)
    {
        $bookingServices = BookingService::where('booking_id', $booking->id)->get();
        $userBooking = User::where('id', $booking->user_id)->get();
        $services = [];

        foreach ($bookingServices as $key => $service) {
            $service = Service::find($service->service_id);
            $services[] = $service;
        }

        return view('booking.show', [
            'services' => $services,
            'userBooking' => $userBooking,
        ]);
    }
}
