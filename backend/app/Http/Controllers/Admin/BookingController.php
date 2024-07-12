<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Province;
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
        $bookings = Booking::where('store_id',$userAuth->store_id)->paginate(10);
        return view('booking.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // Validate the request including the image
        $data = $request->validate([
            'name' => 'required|string|unique:categories,name',
        ]);

        Category::create($data);

        // Redirect back with a success message
        return redirect('/admin/categories')->with('success', 'Category created successfully !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show(Booking $booking)
    // {
    //     $bookingServices = BookingService::where('booking_id', $booking->id)->get();
    //     $userBooking = User::where('id', $booking->user_id)->get();
    //     $services[] = [];
    //     foreach ($bookingServices as $key => $service) {
    //         $service[] = $service;
    //     }
    //     return view('booking.show', [
    //         'bookingServices' => $bookingServices,
    //         'services' => $services,
    //         'userBooking' => $userBooking,
    //     ]);
    // }

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
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit', ['category' => $category]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $rules = [
            'name' => 'required|string',
        ];
        if ($request->name !== $category->name) {
            $rules['name'] .= '|unique:categories,name';
        }
        $data = $request->validate($rules);
        $category->update($data);

        return redirect('/admin/categories')->with('success', 'Category updated successfully !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->withSuccess('Category deleted !!!');
    }
}
