<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Gender;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BookingService;
use App\Models\Service;
use App\Models\User;

class ReportController extends Controller
{
    function __construct()
    {
        $this->middleware('role_or_permission:Report access|Report create|Report edit|Report delete', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:Report create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:Report edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:Report delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $userAuth = Auth::user();
        $bookings = Booking::where('store_id', $userAuth->store_id)->paginate(4);
        $bookingServices = BookingService::all();
        $services = Service::all();

        $data = $this->prepareReportData($bookings, $bookingServices, $services);

        return view('report.index', compact('data'));
    }

    private function prepareReportData($bookings, $bookingServices, $services)
    {
        $data = [];

        foreach ($bookings as $booking) {
            $userBooking = $booking->user;
            $bookingServicesForBooking = $bookingServices->where('booking_id', $booking->id);
            $servicesForBooking = [];

            
            foreach ($bookingServicesForBooking as $bookingService) {
                $service = $services->where('id', $bookingService->service_id)->first();
                $servicesForBooking[] = $service->service_name;
            }
            
            $data[] = [
                'ID' => $booking->id,
                'Customer' => $userBooking->name,
                'Gender' => $userBooking->gender,
                'Email' => $userBooking->email,
                'Date' => date('d-m-Y', strtotime($booking->date)),
                'Time' => date('h:i A', strtotime($booking->time)),
                'Phone' => $userBooking->phone,
                'Service' => implode(', ', $servicesForBooking),
                'Discount' => $userBooking->discount,
                'Total Price' => $booking->total_price,
                'Status' => 'Done', 
            ];
        }

        return $data;
    }
}