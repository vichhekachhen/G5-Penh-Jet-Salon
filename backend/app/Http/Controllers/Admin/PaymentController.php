<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Exception\ApiErrorException;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('role_or_permission:Payment access|Payment create|Payment edit|Payment delete', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:Payment create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:Payment edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:Payment delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::paginate(4);
        return view('payment.index', ['payments' => $payments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payment.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        try {

            $payment = Payment::create([
                'owner_id' => $user->id,
                'amount' => $request->amount,
                'currency' => 'USD',
                'zip_code' => $request->zip_code,
                'payment_method' => $request->payment_method,
            ]);

            $payment->status = 'success';
            $payment->save();
            // Redirect back with a success message
            return redirect('/admin/dashboard')->with('success', 'Payment created successfully !!!');
        } catch (ApiErrorException $e) {
            // Handle error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        return view('payment.edit', ['payment' => $payment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        // Update the payment details in the database
        $payment->amount = $request->amount;
        $payment->save();

        return redirect()->route('payment.index')->withSuccess('Payment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payment.index')->withSuccess('Payment deleted successfully.');
    }
}
