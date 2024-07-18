<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('role_or_permission:Schedule access|Schedule create|Schedule edit|Schedule delete', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:Schedule create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:Schedule edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:Schedule delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = [];
        $userAuth = Auth::user();
        $bookings = Booking::where('store_id', $userAuth->store_id)->get();
        foreach ($bookings as $booking) {
            $events[] = [
                'id' => $booking->id, 
                'title' => 'Customer Booking' ,
                'start' => $booking->date . 'T' . $booking->time,
                'end' => $booking->date . 'T' . $booking->time,
                'color' => 'red',
            ];
        }
        return view('schedule.index', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('schedule.new');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {

        return redirect('/fullcalender');
    }

 
}
